<?php
include_once "navbar.php";
?>
<div id="users">
<script>
    const requestURLAJAX = 'https://jsonplaceholder.typicode.com/users';
    function sendRequest(method, url, body = null) {
        return fetch(url).then( response => {
            return response.json()
        })
    }

    let table = document.createElement('table');
    table.classList.add("table");
    sendRequest('GET', requestURLAJAX).then( data => {
        console.log(data);
        for (let i = 0; i < data.length; i++) {
            const tr = document.createElement('tr');
            tr.setAttribute('scope', 'col')
            const td1 = document.createElement('td');
            const td2 = document.createElement('td');
            const td3 = document.createElement('td');
            const td4 = document.createElement('td');

            var text1 = document.createTextNode(data[i]['id']);
            var text2 = document.createTextNode(data[i]['name']);
            var text3 = document.createTextNode(data[i]['username']);
            var text4 = document.createTextNode(data[i]['email']);

            td1.appendChild(text1);
            td2.appendChild(text2);
            td3.appendChild(text3);
            td4.appendChild(text4);

            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
            table.appendChild(tr);
        }
// Adds the table to the page so you see it -- up until this moment,
// we've just been preparing a table in memory.
        document.body.appendChild(table);

}).catch( error => console.error(error));

</script>
</div>