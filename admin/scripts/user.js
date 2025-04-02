function get_users() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('user-data').innerHTML = this.responseText;
    }
    xhr.send('get_users');
}

function remove_user(user_id) {
    if(confirm("Are you sure you want to delete this user?")) {
        let data = new FormData();
        data.append('user_id', user_id);
        data.append('remove_user', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users.php", true);

        xhr.onload = function() {
            console.log("Server Response:", this.responseText);
            if (this.responseText == 1) {
                alert('success', 'User Deleted!');
                get_users();
            } else {
                alert('error', 'User Removal Failed!');
            }
        }
        xhr.send(data);
    }
}

window.onload = function() {
    get_users();
}