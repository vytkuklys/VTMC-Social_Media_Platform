export default class LocalStorage {
    static getLikedComments() {
        let comments = localStorage.getItem('comments');
        if (comments) {
            comments = JSON.parse(comments);
        } else {
            comments = "losd";
        }
        return comments;
    }

    static addComments(comments) {
        localStorage.setItem('comments', JSON.stringify(comments));
    }
}