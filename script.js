//  Авторизация / Регистрация
const userMenuButton = document.querySelector('.user-icon-button');
const userMenu = document.querySelector('.user-menu');
if (userMenuButton != null) {
  userMenuButton.addEventListener('click', function () {
    if (userMenu.style.display != 'block') {
      userMenu.style.display = 'block';
    } else {
      userMenu.style.display = 'none';
    }
  });
  
  document.querySelector('#user-icon-button').addEventListener('click', function () {
    document.querySelector('.user-menu').classList.toggle('active');
  });
  
  document.querySelectorAll('.menu-button').forEach(function (button) {
    button.addEventListener('click', function () {
      var type = this.dataset.type;
      document.querySelectorAll('.menu-form').forEach(function (form) {
        form.classList.remove('active');
      });
      document.querySelector('.menu-form.' + type).classList.add('active');
    });
  });
}

const pvcButtons = document.querySelectorAll('.pvc-button');

pvcButtons.forEach((button, index) => {
  button.addEventListener('click', () => {
    const pvcLists = document.querySelectorAll('.pvc-list');
    pvcLists.forEach((list) => {
      if (list != pvcLists[index]){
        list.style.display = 'none';
      }
    });
    if (pvcLists[index].style.display != 'block') {
      pvcLists[index].style.display = 'block';
    } else {
      pvcLists[index].style.display = 'none';
    }
  });
});

