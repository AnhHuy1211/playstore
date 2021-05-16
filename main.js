
function show_pass() {
  let pasBox= document.getElementById("password");
  let passBox = document.getElementById("check_password");
  if ((pasBox.type === "password") || (passBox.type === "password") || (passBox.type === "password" && pasBox.type === "password" )) {
    pasBox.type = "text";
    passBox.type = "text";
  }
  else {
    pasBox.type = "password";
    passBox.type ="password";
  }
}
function search () {
  let inputSearch = $('.search-input').val();
  let resultList = $('.search-input').siblings('.search-result-list');
  console.log('1')
  $.get("class-search.php", {term: inputSearch}).done(function(data){
    // Display the returned data in browser
    console.log(data);
    resultList.html(data);
  })
}

function enableSearchBox() {
  let searchField = $('.search-input');
  let resultList = $('.search-result-list');
  searchField.focus();
  resultList.show(400);
}
