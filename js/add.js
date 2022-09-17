//Меню добавления пользователя
let menuAddUser = document.querySelector("#menu-add-user");
let btnAddUser = document.querySelector("#btn-add-user");
let closeAddUser = document.querySelector("#close-add-user");

btnAddUser.onclick = function(){
   menuAddUser.style.display = "block";
}
closeAddUser.onclick = function(){
   menuAddUser.style.display = "none";
}