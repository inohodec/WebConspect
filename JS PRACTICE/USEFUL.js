/*Если нам нужно вывести неизвестное кол-во аргументов функции, то мы можем
использовать Составную частью каждой функции - массив аргументов arguments */
function displayItems() {
    for (i = 0; i < displayItems.arguments.length; i++) {
        document.write(displayItems.arguments[i] + ";");
    }
}
displayItems(1, 2, 3, 4, 5, 6, 7, 8, 6, 65, 56, 56, 78, 878, 1111);



function fixName() {
    var names = "";
    for (i = 0; i < fixName.arguments.length; i++) {
        names += fixName.arguments[i].charAt(0).toUpperCase() + //метод charAt(0) берет 1 символ из строки и применяет toUpperCase
        		fixName.arguments[i].substr(1).toLowerCase() + " ";  //метод substr(1) берет остальные символы начиная с 2-го и применяет toLowerCase
    }
    return names.substr(0, names.length-1);//возвращает значение с удаленным последним пробелом
    //т.е. substr берет символы с 1-го по предпоследний, кот у нас пробел
}
var call = fixName("mAx", "LEnA", "LIZa", "katE"); // output is "Max Lena Liza Kate"
alert(call);