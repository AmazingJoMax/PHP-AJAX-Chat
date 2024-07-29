const chatForm = document.querySelector('.message-input form')
const chatInput = chatForm.querySelector('#message')
const chatBox = document.querySelector('.chat-box')

const getChats = () => {
    let xhr = new XMLHttpRequest()
    xhr.open('POST', '../requires/get_chats.php', true)
    xhr.onload = function () {
        if (this.status == 200) {
            chatBox.innerHTML = this.responseText
            // console.log(this.responseText)
        }else{
            console.log(this.status);
        }
    }
    let chatData = new FormData(chatForm)

    // console.log(chatData);

    xhr.send(chatData)
}

chatForm.onsubmit = (e) => {
    e.preventDefault()
    let xhr = new XMLHttpRequest()
    xhr.open('POST', '../pages/chat.php', true)
    xhr.onload = function () {
        if (this.status == 200) {
            console.log('sent');
            chatInput.value = ''
        }
    }
    let chatData = new FormData(chatForm)
    
    xhr.send(chatData)
getChats()

}

setInterval(() => {
    getChats()
}, 1000)

