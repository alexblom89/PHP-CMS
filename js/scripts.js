

function comparePW(){
    // get the 2 password values from the form & reference the message element
    let pw1 = document.getElementById('password').value;
    let pw2 = document.getElementById('confirm').value;
    let pwMsg = document.getElementById('pwMsg');

    //compare the 2 passwords entered
    if(pw1 !== pw2) {
        //display error message in red
        pwMsg.innerHTML = 'Passwords don\'t match!';
        pwMsg.className = 'text-danger';
        return false;
    }
    else {
        //remove error message
        pwMsg.innerHTML = '';
        pwMsg.className = '';
        return true;
    }
}

function showPW(){
    //reference the password input box
    let pw = document.getElementById('password');
    let img = document.getElementById('showIcon');
    //if the box is currently type password (default), toggle it to type text (and vice-versa)
    if(pw.type === 'password'){
        pw.type = 'text';
        img.src = 'img/hide.png';
    }
    else {
        pw.type = 'password';
        img.src = 'img/show.png';
    }
}

function confirmDelete(){
    return confirm('Are you sure?');
}