function loginSwitchCard() {
    const loginCard = document.querySelector('.login-container .login-card:nth-child(1)');
    const registerCard = document.querySelector('.login-container .login-card:nth-child(2)');
  
    if (loginCard.style.display === 'none') {
      loginCard.style.display = 'block';
      registerCard.style.display = 'none';
    } else {
      loginCard.style.display = 'none';
      registerCard.style.display = 'block';
    }
  }