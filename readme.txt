/* 

YOU CAN USE THIS FILE TO TEST "magicPROLOG" LIBRARY WORKS.

!!!!!! PAY ATTENTION ON THE PATH AND THE NAME YOU CHOOSE FOR YOUR LISTS AND WRITE JSON STRINGS CORRECTLY !!!!!!

+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+                                                                                                                                       +
+                                    FOR MORE INFORMATIONS agneses92@hotmail.it                                                         +
+                                                                                                                                       +
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

*/

include(PATH.'magicPROLOG/magicPROLOG.php');  //How to include.

$json = '{"nome":"felix","cognome":"domesticus"}'; //A JSON string (it could be a normal JSON too)

$persona= array(            //An associative array
    "nome" => "agnese",
    "cognome" => "salutari",
);

$magic=new magicPROLOG();     //Creation of a magicPROLOG object

$magic->delResult();    //Delete old results collected by $magic. Use ADDtoResult($string) 
                       //to add a Prolog string to add to result. 

$magic->JSONtoPmap($json, "gatto");   //Convert JSONs or JSON strings to Prolog maps.

$magic->VALUEStoPlist(["0",2,3], "numbers");  //Convert an array to a Prolog list.

$magic->ASSOCIATIVEARRAYtoPmap($persona, "persona"); //Convert associative arrays to Prolog maps.

$magic->RESULTtoTXT($fileName,$path, false);  //Write on a text document without overwriting it.

$magic->notificationTXT($txt_name, $path);   //Create a "notification" text file in the specified path.

echo($magic->getResult());  //Prints the result.
