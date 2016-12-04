$(document).ready(function() {

    var lock = new Auth0Lock(AUTH0_CLIENT_ID, AUTH0_DOMAIN, options);

    var options = {
  theme: {
    logo: 'img/logo.jpg',
    primaryColor: 'green'
  }  
};

    $('.btn-login').click(function(e) {
      e.preventDefault();

      lock.show({
          callbackURL: AUTH0_CALLBACK_URL
          , responseType: 'code'
          , authParams: {
              scope: 'openid'
          }
      });

    });
});
