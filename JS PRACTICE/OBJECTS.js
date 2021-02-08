/*Объявление класса User и его метода - это рекомендуемый способ*/
function user(name, login, password) {
    //свойства класса
    this.name = name;
    this.login = login;
    this.password = password;
    //метод класса
    this.showUser = function() {
        document.write("name: " + this.name + ";<br>");
        document.write("login: " + this.login + ";<br>");
        document.write("password: " + this.password + ";<br>");
    };
    //метод класса
    this.checkUser = function() {
        if (this.password === "12345") {
            this.message = "You're the right guy";
            this.showMessage(this.message);
        } else {
            this.message = "You're the wrong guy";
            this.showMessage(this.message);
        }
    };
    //метод класса
    this.showMessage = function(message) {
        alert(message);
    };
}
var userID_12 = new user("Nat", "hoRRor", "1245");
userID_12.checkUser();
userID_12.showUser();

var userID_13 = new user();
userID_13.name = "Hank";
userID_13.login = "BoBoBo";
userID_13.password = "4321";
alert(userID_13.password);


/*Раздельное объявление класса и метода - возможный, но нежелательный способ*/
function newUser(forename, username, password)
{
    //свойства класса
    this.forename = forename;
    this.username = username;
    this.password = password;
    this.showUser = showUser;
}
function showUser()
{
    //метод класса
    document.write("Имя: " + this.forename + "<br>");
    document.write("Пользовательское имя: " + this.username + "<br>");
    document.write("Пароль: " + this.password + "<br>");
}

