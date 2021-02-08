var shoes = ["flip-flops", "trainers", "boots"];

for (var i = 0; i < shoes.length; i++) {
    document.write(shoes[i] + "<br>");
}
/*----------АССОЦИАТИВНЫЕ МАССИВЫ-------------*/

var apparel = {
    "nike": "bots",
    "puma": "shorts",
    "umbro": "t-shorts",
    "ecco": "scandals"
};
/*В цикле for  создаеться переменная brand(имя любое) которая задействуется
 *только внутри массива apparel и ей присваиваеться имя ключа ассоциативного массива
 *которую мы можем использовать для вывода информации по ключу*/
for (var brand in apparel) {
    document.write(brand + " : " + apparel[brand] + "<br>");
}
/*-------------МНОГОМЕРНЫЕ МАССИВЫ------------*/
var multi_array = {
    "cars": {
        "BMW": "Sport cars",
        "AUDI": "Classic cars",
        "MAZDA": "Micro cars"
    },
    "laptops": {
        "HP": "Plain laptops",
        "ASUS": "Transformers",
        "ACER": "Buisness laptops"
    },
    "phones": {
        "APPLE": "Premium phones",
        "SAMSUNG": "Unusual phones",
        "XIAOMI": "Cheap phnes"
    },
    "shoes": {
        "D&G": "Premium shues",
        "Clarks": "Classic shues",
        "Crocks": "Ribbon shoes"
    }
};
for (var category in multi_array) {
    document.write("<p>Category: " + category + "</p>");
    document.write("<ul>");
    for (var brand in multi_array[category]) {
        document.write("<li>" + brand + " presents: " + multi_array[category][brand] + "</li>");
    }
    document.write("</ul>");
}


/*--------------ССЫЛКИ НА МАССИВЫ И КОНКАТЕНАЦИЯ--------------------*/
var array = ["one", "two", "three"];
var array_1 = ["one+1", "two+2", "three+3"];

var joinedArray = array.concat(array_1);
joinedArray = joinedArray.concat("thousand", "millione");//добавит в конец массива

for (var i = 0; i < joinedArray.length; i++) {
    document.write(joinedArray[i] + ";");
}
document.write("<hr>");

/*-----Если мы создаем переменную и присваеваем ей значение другого массива,
то создаётся ссылка на уже существующий массив,  а не новая копия. Т.е. если изменить один из них, 
то другой изменится тоже*/
var newArr = array;
newArr.push("ten");
for (var i = 0; i < newArr.length; i++) {
    document.write(newArr[i] + ";");
}
document.write("<hr>");
for (var i = 0; i < array.length; i++) {
    document.write(array[i] + ";");
}
document.write("<hr>");


/*---------------------------------FOR EACH--------------------------------------*/
var pets = ["dog", "cat", "parrot", "fish"];
for (var i = 0; i < pets.length; i++) {
    output(pets[i], [i], pets);
}
//forEach выведет то-же что и цикл, но не работает в IE
pets.forEach(output);//не работает в старых IE, проверил в 11 и Edge, все гуд

function output(element, index, array) {
    document.write("Element with index [" + index + "] contain: '" + element + "'<br>");
}

/*-----------------------------JOIN---------------------------------*/
//создает строку из елементов массива и разделяет указанными в аргументах символами
pets = ["Кошка", "Собака", "Кролик", "Хомяк"];

document.write(pets.join() + "<br>"); //use comas to split up values
document.write(pets.join('*') + "<br>"); //use * to split up values

/*-----------------------------SPLIT----------------------------------*/
//создает массив из елементов строки разделенными указанными в аргументах символами
var string = "Garry; Dezdemona; Pinokio; Superman";
var heroes = string.split(';');
document.write(heroes);

/*------------------------------ UNSHIFT, PUSH и SHIFT, POP--------------------------------*/
// UNSHIFT добавляет значение в начало массива
// PUSH добавляет значение в конец массива

var shoes = ["snickers", "flip-flops"];
shoes.push("scandals");
shoes.push("boots");
shoes.unshift("trainers");
shoes.unshift("slippers");
document.write("<hr>" + shoes.join("; ") + "<hr>");

//SHIFT Удаляет первый элемент массива возвращая его значение
//POP Удаляет последний элемент массива возвращая его значение
var new_shoes = [], arr_length = shoes.length;

for (var i = 0, pop_value; i < arr_length; i++) {
    pop_value = shoes.pop();
    document.write(pop_value + "<br>");
    new_shoes.push(pop_value);
}
document.write(new_shoes.join("; "));

/*---------------REVERSE переставляет элементы массива в обратном порядке----------------*/
sports = ["Футбол", "Теннис", "Бейсбол", "Хоккей"];
rev_sports = sports.reverse(); 
//не забываем что массив sports то же изменился, т.к. rev_sports символическая ссылка
//и вывод sports и rev_sports будет одинаков

/*--------------------------------------SORT---------------------------------------------*/
// Сортировка по алфавиту
sports = ["Футбол", "Теннис", "Бейсбол", "Хоккей"]
sports.sort()
document.write(sports + "<br>")
// Сортировка по алфавиту в обратном порядке
sports = ["Футбол", "Теннис", "Бейсбол", "Хоккей"]
sports.sort().reverse()
document.write(sports + "<br>")


/* Здесь function создает безымянную функцию, отвечающую запросам метода
sort . Если функция возвращает значение больше нуля, сортировка предполагает,
что b ставится перед a . Если функция возвращает значение меньше нуля, сорти-
ровка предполагает, что a ставится перед b . Сортировка запускает эту функцию
применительно ко всем значениям массива для определения порядка их следо-
вания. */
// Сортировка чисел по возрастанию
numbers = [7, 23, 6, 74]
numbers.sort(function(a,b){return a - b})//если возвращает меньше нуля, то порядок правильный
document.write(numbers + "<br>")
// Сортировка чисел по убыванию
numbers = [7, 23, 6, 74]
numbers.sort(function(a,b){return b - a})//если возвращает больше нуля, то порядок правильный
document.write(numbers + "<br>")