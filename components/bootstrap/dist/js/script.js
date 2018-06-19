function signIn() {
  var username = $('#signIn input[name=username]').val();
  var password = $('#signIn input[name=password]').val();
  $.ajax({
    'url': 'api.php',
    'type': 'post',
    'data': {
      'type': 'login',
      'username': username,
      'password': password,
    },
    'success': function(ret) {
      if (ret == 'success') {
        window.location.reload();
      } else {
        $('#signIn .error').html(ret);
      }
    },
    'error': function(e) {
      $('#signIn .error').html(e.statusText);
    }
  });
}

function signUp() {
  var username = $('#signUp input[name=username]').val();
  var password = $('#signUp input[name=password]').val();
  var password2 = $('#signUp input[name=password2]').val();
  if (password != password2) {
    $('#signUp .error').html("password input not match");
    return;
  }
  $.ajax({
    'url': 'api.php',
    'type': 'post',
    'data': {
      'type': 'register',
      'username': username,
      'password': password,
    },
    'success': function(ret) {
      if (ret == 'success') {
        window.location.reload();
      } else {
        $('#signUp .error').html(ret);
      }
    },
    'error': function(e) {
      $('#signUp .error').html(e.statusText);
    }
  });
}

function contact() {
  var name = $('#contact input[name=name]').val();
  var email = $('#contact input[name=email]').val();
  var message = $('#contact textarea[name=message]').val();
  $.ajax({
    'url': 'api.php',
    'type': 'post',
    'data': {
      'type': 'contact',
      'name': name,
      'email': email,
      'message': message,
    },
    'success': function(ret) {
      if (ret == 'success') {
        window.location.reload();
      } else {
        $('#contact .error').html(ret);
      }
    },
    'error': function(e) {
      $('#contact .error').html(e.statusText);
    }
  });
}

function add_cart(itemid) {
  $.ajax({
    'url': 'api.php',
    'type': 'post',
    'data': {
      'type': 'add_cart',
      'itemid': itemid,
    },
    'success': function(ret) {
      if (ret == 'success') {
        alert("success");
      } else {
        alert(ret);
      }
    },
    'error': function(e) {
      alert(e.statusText);
    }
  });
}

function add_review(itemid) {
  var rating = $('#review select[name=rating]').val();
  var review = $('#review textarea[name=review]').val();
  $.ajax({
    'url': 'api.php',
    'type': 'post',
    'data': {
      'type': 'review',
      'itemid': itemid,
      'rating': rating,
      'review': review,
    },
    'success': function(ret) {
      if (ret == 'success') {
        window.location.reload();
      } else {
        $('#review .error').html(ret);
      }
    },
    'error': function(e) {
      $('#review .error').html(e.statusText);
    }
  });
}

function checkout() {
  var address = $('#cart input[name=address]').val();
  $.ajax({
    'url': 'api.php',
    'type': 'post',
    'data': {
      'type': 'checkout',
      'address': address,
    },
    'success': function(ret) {
      if (ret == 'success') {
        alert("success");
        window.location.reload();
      } else {
        alert(ret);
      }
    },
    'error': function(e) {
      alert(e.statusText);
    }
  });
}
