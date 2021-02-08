         empty    is_null 
         ==null  ===null  isset   array_key_exists
      ϕ |   T   |   T   |   F   |   F   
   null |   T   |   T   |   F   |   T   
     "" |   T   |   F   |   T   |   T   
     [] |   T   |   F   |   T   |   T
      0 |   T   |   F   |   T   |   T      
  false |   T   |   F   |   T   |   T   
   true |   F   |   F   |   T   |   T   
      1 |   F   |   F   |   T   |   T   
      0 |   F   |   F   |   T   |   T   



     check == vs ===

'' == NULL - would return true
0 == NULL - would return true
false == null - would return true

where as

'' === NULL  -  would return false
0 === NULL  -  would return false
false === NULL  -  would return false