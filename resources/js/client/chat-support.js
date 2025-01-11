import '../bootstrap.js'


window.Echo.private(`chat-support-${userId}`)
    .listen('SendMessage', (e) => {
        document.getElementById('message-list').insertAdjacentHTML('beforeend', createHTMLMessageFromOther(e.message));
});




document.getElementById('chat-support-form').addEventListener('submit', (e) => {
    e.preventDefault();

    let message = document.getElementById('support-message').value;

    let route = document.getElementById('chat-support-form').getAttribute('action');


    axios.post(`${route}`, {

        message: message

    }).then((response) => {

        document.getElementById('chat-support-form').reset();
        document.getElementById('message-list').insertAdjacentHTML('beforeend', createHTMLMessageFromMe(response.data.message.message));

    }).catch((error) => {

        console.log(error);

    })

})


function createHTMLMessageFromMe(message) {
    const today = new Date();
    const time = today.getHours() + ":" + today.getMinutes() + " " + (today.getHours() > 11 ? "pm" : "am");
    return '<li class="clearfix odd">\n' + '    <div class="chat-conversation-text ms-0">\n' + '        <div class="d-flex justify-content-end">\n' + '            <div class="chat-ctext-wrap">\n' + '                <p>' + message + '</p>\n' + '            </div>\n' + '        </div>\n' + '        <p class="text-muted fs-12 mb-0 mt-1 d-flex justify-content-end">' + time + '<i class="bx bx-check-double ms-1 text-primary"></i></p>\n' + '    </div>\n' + '</li>\n';
}

function createHTMLMessageFromOther(message) {
    const today = new Date();
    const time = today.getHours() + ":" + today.getMinutes() + " " + (today.getHours() > 11 ? "pm" : "am");
    return '<li class="clearfix">\n' + '    <div class="chat-conversation-text">\n' + '        <div class="d-flex">\n' + '            <div class="chat-ctext-wrap">\n' + '                <p>' + message + '</p>\n' + '            </div>\n' + '        </div>\n' + '        <p class="text-muted fs-12 mb-0 mt-1 ms-2">' + time + '</p>\n' + '    </div>\n' + '</li>';
}
