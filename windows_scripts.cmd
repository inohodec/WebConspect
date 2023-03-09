************ Про кодировку *************
К сожалению, заранее угадать, в какой кодировке выводится текст, невозможно, поэтому проще 
попробовать установить командой chcp разные кодировки, чтобы добиться правильного 
отображения русского текста. Обычно используются кодировки 866 (кодировка русского 
текста DOS), 1251 (кодировка русского текста Windows), 65001 (UTF-8).



rem shows command's help info
XCOPY /? 

rem выводит справку постранично, ожидая нажатия пробела от пользователя
XCOPY /? | MORE

********** Перенаправление ввода вывода ***************
rem выводит справку в указанный файл (создаст при необходимости) as in linux
XCOPY /? > help.txt
rem выводит справку в конец указанного файла (создаст при необходимости) as in linux
XCOPY /? >> help.txt
rem выводит на пустое устройство(типа /dev/null в линукс)
XCOPY /? > NUL
rem передает комманде DATE дату из файла
DATE < file_with_date.txt
rem выводит сообщение об ошибке выполнения в файл
some_command 2> error.log
rem перенаправит стандартный вывод о копировании и/или вывод об ошибке в файл
XCOPY C:\file.txt E:\some_folder\ > copy_log.txt 2>&1
rem варианты перенаправления вывода
TYPE news.txt | MORE
MORE news.txt
MORE < news.txt

rem sorting отсортирует строки по столбцу(по умолчанию первый символ)
sort copy_log.txt
rem reverse sorting, will be use 4rth symbol for sorting
sort /R /+4 copy_log.txt


*********************** Условное выполнение и группировка ************************

rem output dir elements and wait fot button pressing and shows copy help
DIR & PAUSE & COPY /? | MORE

rem ^ экранирует спецсимволы выведет "Abc & COPY /?"
ECHO Abc ^& COPY /?

rem [cmd1] & [cmd2 -run anyway] []run && run command if previous command was success and || if not
rem [cmd1] && [cmd2 -run if cmd1 were success]
rem [cmd1] || [cmd2 -run if cmd1 were false]
TYPE file.txt & ECHO Output the text anyway
TYPE file.txt && ECHO File exists
TYPE file.txt || ECHO File does'nt exist
rem in first exanple "ECHO Output the text anyway" runs anyway
rem in second if "TYPE file.txt" were success? commands in brackets will run
TYPE file.txt && ECHO File exists & ECHO Output the text anyway
TYPE file.txt && (ECHO File exists & ECHO command ^TYPE were sucess)

************************** Работа с файловой системой *************************
rem "?" - one any symbols, "*" - some any symbols

rem change directory on root in actial disk
CD \

rem COPY as default use files as text, for changibg use /B - it's mean binary
rem COPY [from] [to] /[Y/-Y ask/don't ask replacement of file] /[Y file checking after copy]
COPY *.txt D:\docs /Y /V
COPY manual_xerox_???.txt D:\docs\xerox_mans /Y /V 

REM copy all FILES in currnt catalog
COPY D:\xerox_mans\*.*

rem copy content of 2 files to 1, rewrite or create file 3
COPY 1.txt+2.txt 3.txt

rem можно ввести в комстроку текст который поместиться в файл 3.txt(exit Ctrl+Z)
COPY CON 3.txt

rem по сути запятые это пропуск параметра приемника, т.е. добавит файлу пустое содержимое и изменит дату файла
COPY 1.txt +,,

rem MKDIR или MD не может быть выполнена если каталог уже существует
MD D:\backup
rem RMDIR или RD
MD D:\backup /S

rem DEL - delete file/es
DEL C:\backup\2022-*.log

rem REN rename directory/file, работает только на одном и том же лог.диске, если конечный файл существует, будет ощибка
REN *.txt *.doc

rem Переименование папки: MOVE [/Y | /-Y] [диск:][путь]имя_папки новое_имя_папки
move C:\new_test D:\test_

*****************  ЯЗЫК CMD ********************

REM ECHO OFF отключает вывод комманд в CMD, т.е мы увидим только результат их выполнения, но сам ECHO OFF все же выведеться
REM @ отключает вывод для конкретной строки

@MD D:\backup /S
REM REN будет выведена в CMD
REN *.txt *.doc

REM ECHO выводит сообщение
ECHO "ЯЗЫК CMD"
REM ECHO. выводит пустую строку, пробела быть не должно
ECHO.

REM если копирование было успешно, то запишет сообщение в лог
XCOPY C:\SOME_FOLDER D:\SOME_FOLDER /S
IF NOT ERRORLEVEL 1 ECHO "COPYING WAS SUCCESSFULL" >> report.log

*****************  Параметры CMD ********************
REM параметры CMD начинаються с %0 до %9, где %0 это название скрипта, %* это все аргументы
REM если в скрипте используються не переданные параметры, то они замещаються ""
ECHO File %0 copy %1 and %2
REM %~Fn(%~F5) подставит вперед к 5ому параметру путь до скрипту(т.е. до папки с ним и ), предназначено для аргументов файлов
REM CMD> script.bat cmd.exe    output>C:\Users\judas\arg1
ECHO %~F1           // C:\Users\judas\cmd.exe
ECHO %~D1           // C:
ECHO %~P1           // \Users\judas\
ECHO %~N1           // cmd 
ECHO %~X1           // .exe
ECHO %~S1           // C:\Users\judas\cmd.exe какие-то короткие имена хз
ECHO %~$PATH:1      // C:\Windows\System32\cmd.exe ищет файл в PATH и если находит заменяет на полный путь

***************** Переменные среды ********************
ECHO %WINDIR%
REM set user envirement variable using SET
SET MyVar=Hello BRO!
ECHO %MyVar%
REM B=12(string) , C=1+2(string)
SET A=1
SET B=2
SET D=%A%%B%
REM substrings of variables %variable:~x,y where x=shift, y=symbols quantity, - gets last n symbols
REM %m:~3,2% output>de, %m:~3,2% output>def, output>ef
SET m=abcdef
ECHO %m:~3,2%
ECHO %m:~3%
ECHO %m:~-2%

REM substring replacement %variable:substr=replc%, output 02:05:1984, output 02-05-2000
set DOB=02-25-1984
ECHO %DOB:-=:%
ECHO %DOB:1984=2000%

REM Действия с перемнными как с числами SET /A %var1% + %var2%
SET /A a=5
>5
SET /A b=8
>8
SET /A c=%a% + %b%
>10

REM SET создает переменные только для текущего командного окна, т.е если файл выполнился но окно не закрыть
REM переменные живы, для этого используют SETLOCAL ENDLOCAL, переменные будут действовать между ними, 
REM в файле могут быть несколько конструкций(аналог локальной области видимости)

REM При группах команд могут быть проблемы с выполнением - output > 1, 2
SET A=1 
ECHO %A%
SET A=2 
ECHO %A%

REM output > 1, (SET A=2 ECHO 1), 1 
SET A=1 
ECHO %A%
(SET A=2 
ECHO %A%)

REM SETLOCAL ENABLEDELAYEDEXPANSION and use !variable! insted of %variable%
SETLOCAL ENABLEDELAYEDEXPANSION
SET A=1 
ECHO %A%
(SET A=2 
ECHO !A!)

REM Pause -> use PAUSE
ECHO Press Ctrl+C for canceling!
PAUSE
DEL *.txt

REM call external *.bat or *.cmd, for continuing current script use CALL
ECHO Script will delete temp folder and make files backup, for canceling press Ctrl+C
PAUSE 
REM witout call, rest of script won't execute, script will end
CALL do_backup.bat
DEL %TEMP%\*.*


*********************** Операторы перехода *************************
REM Use [GOTO or CALL] :label
COPY %file_a% %file_b%
GOTO message
ECHO This message won't never be showing 
:message
ECHO Some message

REM Use GOTO :EOF for going to end of current file
SET A=Hello
GOTO :EOF
REM ECHO %A% won't be executed
ECHO %A%

REM CALL в данном случае создает новый контекст. Запустим файл с параметром ExternalArg, в начале ECHO %1
REM выведет "ExternalArg", потом перескочит на :label и выведет наши аргументы "InnerArg_1" и "InnerArg_2"
REM потом скрипт продолжит выполнение со строки ECHO "Will not bo showed" и выведет аргументы %1(ExternalArg) %2("")
REM для выхода нужно 2 раза достичь его конца, тюею конца нового контекста, а потом конца самого скрипта
ECHO %1
CALL :label InnerArg_1 InnerArg_2
ECHO Will not bo showed
:label
ECHO %1 %2

********************* Условия ***********************
REM IF [NOT] var1 == var2 [ELSE], EQU — =, NEQ — !=, LSS — <, LEQ — <=, GTR — >,GEQ — >=
REM сравнивать с пустой строкой нельзя если переменной нет, она будет заменена на "",
REM кавычки для литеральных строк не требуються, для избежания ошибок сравнения с пустой строкой добавляют любой символ
REM -%1==-C:\some_folder is exist, ключ /I - без учета регистра 
IF -%1==-HelloBro ECHO %1 "==" HelloBro
PAUSE

IF /I -%1==-HelloBro (
    ECHO %1 "==" HelloBro
) ELSE (
   ECHO %1 "<>" HelloBro
)
PAUSE
REM Or in one line
IF -%1==-HelloBro (ECHO %1 "==" HelloBro) ELSE (ECHO %1 "<>" HelloBro)
PAUSE

@ECHO OFF
IF -%1==-HelloBro (
    ECHO %1 "==" HelloBro 
    PAUSE
) ELSE (
    ECHO %1 "<>" HelloBro 
    PAUSE
)

REM (NOT) EXIST - Checks if file exists
IF NOT EXIST %1 (
    ECHO file doesn't exist
    GOTO :EOF
    )
ECHO File exist
GOTO :EOF

REM Проверка переменной среды делаеться через DEFINED
IF DEFINED MyVar GOTO :label

REM Проверка завершения команды, для сравнения можно использовать операторы
XCOPY my.txt C:\>NUL
IF ERRORLEVEL 1 GOTO ErrOccured
ECHO file was copied SUCCESSFULL
GOTO EOF
:ErrOccured
ECHO There was some error with file copying

************* Циклы ***************************У

REM FOR %%i IN(scope) DO command [parameters]   ВАЖНО - %%i вместо "i" любая ОДНА буква!
REM > one >two >three
FOR %%i IN (one,two,three) DO ECHO %%i
REM > one,two  >three
FOR %%i IN ("one,two",three) DO ECHO %%i

REM FOR [/R recursing output directory] %%i , /D - current directory's directories
REM FOR [/L num cycle] FOR %%i IN (start,step,end) DO
for /L %%f IN (1,1,5) DO CALL:output %%f
GOTO EOF
:output
set /A m=10*%1
ECHO 10*%1=%m%

REM Обработка файлов построчно, EOL="любой символ комментрария", пропустит эти строки
REM TOKENS=2,4,* числа значат номера найденых подстрок без пробелов по краям, которые будут взяты
REM * значит остаток строки, если одна звездочка, то вся строка
REM DELIMS=,~ символ/лы без пробела, которые будут заменены на пробел
REM выведет 2 и четвертую подстроку, а так же остаток строки и заменит все * и ~
REM пробелы. %%a - мы объявили в цикле, остальные добавляються автоматом исходя
REM из TOKENS=2,4,* (будут добавлены 2 переменных %%a уже есть), переменные идут последовательно 1 за 2 %%b,%%c,%%d и т.д.
FOR /F "EOL=- TOKENS=2,4,* DELIMS=,~" %%a IN (file.txt) DO ECHO %%a %%b %%c

REM Возможна и подстановка синтаксических конструкций для работы с файлами
FOR %%a IN (*.txt) DO ECHO ECHO %~Fa