    Download this JAR file.

    After download rename it to JetbrainsLicense.jar.

    Move this file to some folder. I moved it to my user profile folder so I have it at C:\Users\maxst\JetbrainsLicense.jar.

    Open bin/webstorm.exe.vmoptions file, for example for me it's at C:\Program Files\JetBrains\WebStorm 2017.3.2\bin\webstorm.exe.vmoptions.

    At the end of this file paste this and save (replace path to .jar file with your path, make sure it doesn't have quotes):


    -javaagent:C:\Users\maxst\JetbrainsLicense.jar
    
    Do the same for bin/webstorm64.exe.vmoptions file, paste the same into this file as well.

    Copy-paste a text from there into some text editor.

    Instead of Your Name type whatever you want, this will be displayed at startup and in the license info.

    Now launch your JetBrains product, use Activation code as an activation method, paste text from step #8 and press OK.

    Enjoy.

Linux / OS X

Everything is the same, you have to move JetbrainsLicense.jar to somewhere and then put its path into .vmoptions file.
Tip

You can launch this JAR file in console to see instructions:
$ java -jar ./JetbrainsLicense.jar