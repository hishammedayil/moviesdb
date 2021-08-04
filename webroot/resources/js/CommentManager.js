const CommentManager = class {
    _movie;
    _getUrl;
    _postUrl;
    _axios;
    _tpl;
    constructor (movie, getUrl, postUrl, axios) {
        this._movie = movie;
        this._getUrl = getUrl;
        this._postUrl = postUrl;
        this._axios = axios;
        this._tpl = document.getElementById('comment-template');
    }

    init() {
        this._listen();
        this._getComments();
        this._setupPostComment();
    }

    _listen() {
        Echo.channel('movie-comments.' + this._movie.id)
            .listen('NewComment', (comment) => {
                this._prependCommentsList(comment);
            });
    }

    _prependCommentsList (comment) {
        const instance = this._buildCommentView(comment)
        document.getElementById('comments-container').prepend(instance)
    }

    _buildCommentView(comment) {
        const instance = document.importNode(this._tpl.content, true);

        instance.querySelector('.comment-heading').innerHTML = comment.user.name;
        instance.querySelector('.comment-content').innerHTML = comment.comment;
        instance.querySelector('.comment-time').innerHTML = comment.posted_at;

        return instance
    }

    _getComments() {
        this._axios.get(this._getUrl)
            .then((response) => {
                response.data.forEach(comment => {
                    const instance = this._buildCommentView(comment);
                    document.getElementById('comments-container').appendChild(instance);
                });
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    _setupPostComment() {
        const _this = this;
        document.getElementById('post-comment').addEventListener('click', function() {
            const commentField = document.getElementById('comment-text');
            _this._doPost(commentField);
        });
    }

    _doPost(commentField) {
        this._axios.post(this._postUrl, {
            comment: commentField.value
        })
            .then((response) => {
                this._prependCommentsList(response.data);
                commentField.value = '';
            })
            .catch(function (error) {
                console.log(error);
            })
    }
}

export default CommentManager;
