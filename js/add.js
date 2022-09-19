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
//Меню добавления месторождения
let menuAddMining = document.querySelector("#menu-add-mining");
let btnAddMining = document.querySelector("#btn-add-mining");
let closeAddMining = document.querySelector("#close-add-mining");

btnAddMining.onclick = function(){
   menuAddMining.style.display = "block";
}
closeAddMining.onclick = function(){
   menuAddMining.style.display = "none";
}
//Меню добавления геологических данных
let menuAddGeology = document.querySelector("#menu-add-geology");
let btnAddGeology = document.querySelector("#btn-add-geology");
let closeAddGeology = document.querySelector("#close-add-geology");

btnAddGeology.onclick = function(){
   menuAddGeology.style.display = "block";
}
closeAddGeology.onclick = function(){
   menuAddGeology.style.display = "none";
}