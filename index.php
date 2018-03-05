<?php

if(isset($_GET['good2']))
{
   ?><span class="formGood2">Merci ! Votre inscription a la newsletter et a Hylemagia a bien ete enregistre.</span><?php
}

if(isset($_GET['good1']))
{
    ?><span class="formGood">Merci ! Votre inscription a Hylemagia bien ete enregistre.</span><?php
}
   
   
        
   function newNews($name , $mail)
   {      
      try
      {
          $pdo_option = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Permet de traquer les erreurs et exceptions
                          PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci' ]; // Envoie une commande d'initialisation au serveur de base de donnÃ©es
                          
          $bdd= new PDO ('mysql:host=localhost;dbname=objectif_hylemagia','objectif_hylemag', 'z39n(hsK}!5+' , $pdo_option);
      }
      catch(PDOException $msg)
      {
          die($msg -> getMessage());
      }
      
      if(($resource = $bdd->prepare('INSERT INTO user_mail(email , pseudo) VALUES(:email , :pseudo)'))!==FALSE)
      {
         if($resource->execute(["email"=>$mail, "pseudo"=>$name]))
         {
             return true;
         }
      }
      
      return false;
   }
   
   function newUser($name , $lastName , $age , $email , $country)
   {
      try
      {
          $pdo_option = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Permet de traquer les erreurs et exceptions
                          PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci' ]; // Envoie une commande d'initialisation au serveur de base de donnÃ©es
                          
          $bdd= new PDO ('mysql:host=localhost;dbname=objectif_hylemagia','objectif_hylemag', 'z39n(hsK}!5+' , $pdo_option);
      }
      catch(PDOException $msg)
      {
          die($msg -> getMessage());
      }
      
      if(($resource = $bdd->prepare('INSERT INTO user(user_name , user_l_name , user_coutry, user_b_day , user_crea_day , user_email)
                                    VALUES(:user_name , :user_l_name , :user_coutry, :user_b_day , DATE(NOW()) , :user_email)'))!==FALSE)
      {
         if($resource->execute(["user_name"=>$name, "user_l_name"=> $lastName, "user_coutry" => $country, "user_b_day"=> $age, "user_email"=>$email]))
         {
             return true;
         }
      }
      
      return false;
   }

   if(isset($_GET['in']))
   {
      if(isset($_POST["name"]) AND isset($_POST["lastName"]) AND isset($_POST["age"]) AND isset($_POST["email"]) AND isset($_POST["country"]))
      {
         if(strlen($_POST["name"])>1 AND strlen($_POST["lastName"])>1 AND is_string($_POST["lastName"]) AND is_string($_POST["name"]))
         {
            if(is_numeric($_POST["age"]))
            {
               if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) //veirf mail
               {
                   if(isset($_POST["newsletter"]))
                  {
                     if($_POST["newsletter"]=="on")
                     {
                        if(newNews( $_POST["name"] ." ". $_POST["lastName"] , $_POST["email"]))
                        {                           
                           header('Location: ./index.php?good2');
                           exit;
                        }
                        else
                        {
                           ?><span class="formErr">Une erreur interne est survenue lors du traitement du formaulaire.</span><?php
                        }
                     }
                  }
                  
                 
                  if(newUser($_POST["name"] , $_POST["lastName"] , $_POST["age"] , $_POST["email"] , $_POST["country"]))
                  {
                     ?><span class="formGood">Merci ! Votre inscription a bien ete enregistre.</span><?php
                     header('Location: ./index.php?good1');
                           exit;
                  }
                  else
                  {
                     ?><span class="formErr">Une erreur interne est survenue lors du traitement du formaulaire.</span><?php
                  }
               }
               else
               {
                  ?><span class="formErr">Veillez saisir votre addresse mail correctement.</span><?php
               }
            }
            else
            {
               ?><span class="formErr">Veillez saisir votre age correctement.</span><?php
            }
         }
         else
         {
            ?><span class="formErr">Votre Nom et/ou Prénom sont/n'est pas correct.</span><?php
         }
      }
      else
      {
         ?><span class="formErr">Une erreur est survenue lors du traitement du formaulaire.</span><?php
      }
   }


?>


<!DOCTYPE html>
    
<html lang="en">
<head>
   <title>Bienvenue - HYLEMAGIA</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="styles/index.css" />
   <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
   <link rel="icon" href="./medias/favicon.ico" type="image/x-icon">
   <META NAME="ROBOTS" CONTENT="INDEX, NOFOLLOW">
</head>
    
<body>
    <header>
        <div class="container">
            <div></div>
            <figure>
                <img src="./medias/logo.PNG" alt="Hylemagia - Page d'Accuiel">
                <figcaption>LA SURVIE DES DEUX MONDES REPOSE SUR VOUS</figcaption>
            </figure>
            
            <nav>
                <a href=""></a>
            </nav>
            <div class="hiddenNav">
                  <a href="#histoire">Histoire</a>
                  <a href="#combat">Duel</a>
                  <a href="#forms">S'incrire</a>
            </div>
        </div>
    </header>
    <div class="chevHaut">
        <a href="#forms">
        </a>
    </div>
    
    
    <main>
       <h1>L'HISTOIRE D'HYLEMAGIA</h1>
         <article id="histoire">
         <p>
         La hyacinthe est une pierre qui, depuis le début des âges, est source de puissance 
         magique pour les uns, energie technologique pour les autres. Deux civilisations, les 
         dragons et les explorateurs, peuples antagonistes, l’ont mise au centre de leurs priorités.
         Seulement, depuis maintenant des années, il devient de plus en plus difficile d’en trouver, les 
         gisements s’épuisant. L’âge d’or et l’opulence ne sont maintenant plus qu’un lointain
         souvenir.
         </p>
        </article>
         <div class="branche1"></div>
      <h1>LES DEUX MONDES</h1>
      <article id="combat">
         <div>
            <img src="./medias/hero1.PNG" alt="hero Uncharted">
         </div>
         <div id="centralContainer">
            <div id="dialogUncharted"></div>
            <div>
               <a onclick="talk();">Dialogue</a>
            </div>
            <div id="dialogHeroic"></div>
         </div>
         <div>
             <img src="./medias/hero2.PNG" alt="hero Heroic Fantasy">
         </div>
      </article>
      <div class="branche2"></div>
      <article id="forms">
         <h3>Pré-inscription au jeu</h3>
         <form method="post" action="?in#forms">
            <input type="text" name="name" placeholder="Nom" style="margin-right: 5%;">
            <input type="text" name="lastName" placeholder="Prénom"><br>
            <!-- <input type="number" name="age" placeholder="Age" style="margin-right: 5%;"> -->
            <select name="age" style="margin-right: 5%;">
               <option value="none">Age</option>
               
               <?php
               
               $inter = range(5 , 100);
               
               foreach($inter as $elem)
               {
                  ?><option value="<?php echo $elem; ?>"><?php echo $elem; ?></option><?php
               }
               
               ?>
               
               
            </select>
            <input type="text" name="email" placeholder="Email"><br>           
            <select name="country" style="margin-right: 5%;">
               <option value="none">Pays...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
            </select><br class="lineBreak">
            <label for="newsletter">Inscription newsletter
            <input type="checkbox" name="newsletter" id="newsletter">
            </label><br>
            <input type="submit" value="Envoyer" id="send" style="cursor: pointer;">
         </form>
      </article>
      <div class="branche3"></div>
    </main>
    
    <footer>
      <div>
         <div id="logoContFoot">
            <a href="#histoire" title="Hylemagia">
               <img alt="Hylemagia" src="./medias/logo.PNG">
            </a>
         </div>
         <div id="socialContFoot">
            <div><img alt="Facebook" src="./medias/fb.PNG"></div>
            <div><img alt="Twitter" src="./medias/twitter.PNG"></div>
            <div><img alt="Youtube" src="./medias/youtube.PNG"></div>
         </div>
      </div>
    </footer>
    
<script type="text/javascript">
   var count=0;
   var count2=0;
   var lastUniv = "uncharted";
   
   function talk(){
   
      if(lastUniv!=null)
       {
         switch(lastUniv)
           {
            case "uncharted":
               lastUniv = "heroic";
                  unchar();
                  break;
               case "heroic":
               lastUniv = "uncharted";
                  heroic();
                  break;
           }        
       }
   }
   
   function unchar() {
   
      var diag = ["Bonjour" , "Oui et toi?" , "Et la mif?" , "T'est sure?" , "Ca ira" , "A toi aussi!"];
       
      var DiagSize = diag.length;
       
       if(count>=DiagSize)
       {
         count = 0;
       }
      
       var prev = document.getElementById('uncharted');
   
      if(prev != null)
       {
         prev.remove();
       }
       
       var container = document.getElementById('dialogUncharted');
      
       var div = document.createElement("DIV");
       div.setAttribute("id","uncharted");
       
       var p = document.createElement("P");
       
       var t = document.createTextNode(diag[count]);
       
       p.appendChild(t);
       div.appendChild(p);
       container.appendChild(div);
       
       count++;
   }
   
   
   function heroic() {
   
      var diag = ["Salut! Tu va bien?" , "Ca va ca va" , "Tranquile tranquile" , "Arrete de me parler" , "Bonne journee"];
       
       var DiagSize = diag.length;
       
       if(count2>=DiagSize)
       {
         count2 = 0;
       }
   
      var prev = document.getElementById('heroic');
   
      if(prev != null)
       {
         prev.remove();
       }
       
      var container = document.getElementById('dialogHeroic');
      
       var div = document.createElement("DIV");
       div.setAttribute("id","heroic");
       
       var p = document.createElement("P");
       
       var t = document.createTextNode(diag[count2]);
       
       p.appendChild(t);
       div.appendChild(p);
       container.appendChild(div);
       
       count2++;
   }

</script>
   
</body>
</html>
