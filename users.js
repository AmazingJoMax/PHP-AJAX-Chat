const searchForm = document.querySelector('.search-bar')
const searchInput = document.querySelector('.search-bar input')
const usersList = document.querySelector('.users-list')

const getFilteredUsers = () => {
    let xhr = new XMLHttpRequest()
    xhr.open('POST', '../requires/get_users.php', true)
    xhr.onload = function () {
        if (this.status == 200) {
            usersList.innerHTML = this.responseText
        }
    }
    let formData = new FormData(searchForm)

    xhr.send(formData)
}

getFilteredUsers()

setInterval(() => {
    getFilteredUsers()
}, 1000);

searchInput.oninput = () => {
    getFilteredUsers()
}
