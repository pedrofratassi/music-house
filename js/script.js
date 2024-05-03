const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.registro-link');
const botaoPopUp = document.querySelector('.botaoLogin_PopUp');
const iconClose = document.querySelector('.icon-close');


  registerLink.addEventListener('click', () => {
      wrapper.classList.add('active');
  });

  loginLink.addEventListener('click', () => {
      wrapper.classList.remove('active');
  });

  botaoPopUp.addEventListener('click', () => {
      wrapper.classList.add('active-popUp');
  });

  iconClose.addEventListener('click', () => {
      wrapper.classList.remove('active-popUp');
  });