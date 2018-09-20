<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/style.css">
	<link rel='shortcut icon' href='/favicon.png' type='image/x-icon' />
        <a class="homepage" href="/">
            <h1 class="homepage">The Online Treasury of Yiddish Poetry</h1>
            <h1 class="homepage yid" dir="rtl">דער ״אױפֿן־װעב״ אוצר פֿון ייִדישע לידער</h1>
        </a>
        <title>New Entry</title>
    </head>
    <body>
        <?php
          require_once '/your/path/to/mysql_config.php';
          // Create connection
          $mysql = new mysqli($servername, $username, $password, $dbname);
          $mysql->set_charset('utf8');
          // Check connection
          if ($mysql->connect_error) {
            die("Connection failed: " . $mysql->connect_error);
          }
          $sql = "SELECT name_y, name_e FROM poet ORDER BY name_e";
        ?>
        <form id="poem_form" action="/entry/entry_maker.php" method="post" enctype="multipart/form-data">
		<div class="instructions">
	    		<h3>How to submit a poem:</h3>
			This form can be used to submit a Yiddish poem to the database. Ideally the form will be completed in full and the contributer will provide: the Yiddish poem and its source, an English translation, a blurb about the poet (if the poet is not already in the databse), and image of the poet and its source, a blurb on context, some kind of contextual image and its source, a recording of the poem (in Yiddish), and interesting links. You may, however, submit the Yiddish poem and its source without the additional items because our priority is to simply amass poems. 
Some points:
<ul>
<li>Be thorough! Cite everything that can be cited, images and the poem have their own fields for this, recordings can be linked to in the resources section. Include title, author/editor, publisher, year, city</li>
<li>If bibliographic information is in Yiddish, cite the work in Yiddish, i.e.: <span dir="rtl">אױפֿן זאַמדיגען װעג, יוסף ראָלניק, גרײזעל און קאָמפּאַני, ניו־יאָרק, 1911.
</span></li>
<li>An image citation should be as thorough as possible, image archives have good examples of this. If information cannot be found just make sure you note where its from</li>
<li>Translations of the poem are not required, but translations of the poem's title are!</li>
<li>If a date is specified on the poem itself, use this info for the date field, otherwise use the publication date</li>
<li>The bio and context blurbs should be original works for this site and their authors are not credited</li>
<li>Context and bio blurbs should be in English</li>
<li>The context blurb can be anything from short analysis to historical context, but it is a blurb not an essay. Feel free to link to essays and papers and books in the resources section</li>
<li>The context image can be anything you think is relevant--you can explain the relevance in the blurb or not</li>
<li>Check the dropdown menu to check if the poet is already in the database. Check for various possible spellings. If not there, select new poet</li>
<li>Should the poem be transcribed in "standard" Yiddish? We haven't decided but would love to hear opinions</li>
<li>To add to or edit an existing entry please contact us</li>
<li>Any other questions please contact us</li>
<li>TO SUBMIT THE FORM input your email at the end of this page and the password--this password is only a small measure taken to prevent random submissions. If you do not know it send us an email</li>
</ul>		
</div>

            <fieldset>
                <legend>The Poem, in English</legend>
                Poem Title:<br>
                <input type="text" name="title_eng" placeholder="Title" required>
                <br>
                Poet:<br>
                <select class="name_e" type="text" name="poet_eng">
                    <option value="new" selected>New Poet:</option>
                    <?php
                    $results = $mysql->query($sql);
                    while($result = $results->fetch_assoc()) {
                      echo '<option value="' . $result['name_e'] . '">' . $result['name_e'] . '</option>';
                    }?>
                </select>
                <input type="text" name="new_poet_eng" class="poet" placeholder="New Poet">
                <br>
                Translator:<br>
                <input type="text" name="translator" placeholder="Translator">
                <br>
                The Poem:<br>
                <textarea name="poem_eng" rows="10" cols="100" placeholder="The Poem (its translation)."></textarea>
                <br>
                Publication Date: <br>
                Month:
                <select name="month">
                    <option value="00">N/A</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                Day:
                <input type="number" name="date" min="0" max="31" value="0">
                Year:
                <input type="number" name="year" placeholder="1900">
            </fieldset>
            <br>
            <fieldset>
                <legend>The Poem, in Yiddish</legend>
                Poem Title:<br>
                <input type="text" name="title_yid" placeholder="טיטל" dir="rtl" required>
                <br>
                Poet:<br>
                <select class="name_y" type="text" name="poet_yid" dir="rtl">
                    <option value="new" dir="rtl" selected>נײַער דיכטער</option>
                    <?php
                    $results = $mysql->query($sql);
                    while($result = $results->fetch_assoc()) {
                      echo '<option value="' . $result['name_e'] . '" dir="rtl">' . $result['name_y'] . '</option>';
                    }?>
                </select>
                <input type="text" name="new_poet_yid" class="poet" placeholder="נײַער דיכטער">
                <br>
                Source:<br>
                <input type="text" name="poem_source" placeholder="מקור" dir="rtl" required>
                <br>
                The Poem:<br>
                <textarea name="poem_yid" rows="10" cols="100" dir="rtl" placeholder="דאָס ליד!" required></textarea>
            </fieldset>
            <br>
            <fieldset>
                <legend>The Recording</legend>
                The Poem Reading:<br>
                <input type="file" name="rec" accept="audio/*">
                <br>
                The Reader: <br>
                <input type="text" name="reader" placeholder="The Reader">
            </fieldset>
            <br>
            <fieldset>
                <legend>Poet Blurb</legend>
                About the Poet:<br>
                <textarea name="bio" class="poet" rows="10" cols="100" placeholder="Write something interesting about the poet!"></textarea><br>
                Birth Date: <br>
                Month:
                <select name="b_month" class="poet">
                    <option value="00">N/A</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                Day:
                <input type="number" class="poet" name="b_date" min="0" max="31" value="0">
                Year:
                <input type="number" class="poet" name="b_year" placeholder="1900">
                <br>
                Death Date: <br>
                Month:
                <select name="d_month" class="poet">
                    <option value="00">N/A</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                Day:
                <input type="number" name="d_date" class="poet" min="0" max="31" value="0">
                Year:
                <input type="number" name="d_year" class="poet" placeholder="1900"><br>
                A Photo of the Poet: <br>
                <input type="file" name="poet_img" class="poet" accept="image/*">
                <br>Photo Credit:<br>
                <input type="text" name="poet_img_credit" class="poet" placeholder="Give it where it's due!">
                <br>
            </fieldset>
            <br>
            <fieldset>
                <legend>Context Blurb</legend>
                Give Some Context:<br>
                <textarea name="con" rows="10" cols="100" placeholder="Write some historical/social/literary background relevant to this poem, poet, time, etc."></textarea><br>
                An Illuminating Image: <br>
                <input type="file" name="con_img" accept="image/*">
                <br>Photo Credit:<br>
                <input type="text" name="con_img_credit" placeholder="Give it where it's due!">
                <br>
            </fieldset>
            <br>
            <fieldset>
                <legend>Resources</legend>
                More on the poet: <br>
                <div id="poet_links">
                    URL:
                    <input type="text" name="poetlink[0]" class="poet" placeholder="http://example.com">
                    Title:
                    <input type="text" name="poetlink_title[0]" class="poet" placeholder="An Example">
                    <br>
                </div>
                <div id="poet_links_append"></div>
                <input type="button" id="morelinks" onclick="morePoetLinks()" value="+" />
                <br><br>
                More on the poem: <br>
                <div id="poem_links">
                    URL:
                    <input type="text" name="poemlink[0]" placeholder="http://example.com">
                    Title:
                    <input type="text" name="poemlink_title[0]" placeholder="An Example">
                    <br>
                </div>
                <div id="poem_links_append"></div>
                <input type="button" id="morelinks" onclick="morePoemLinks()" value="+" />
                <br><br>
                More on context: <br>
                <div id="con_links">
                    URL:
                    <input type="text" name="conlink[0]" placeholder="http://example.com">
                    Title:
                    <input type="text" name="conlink_title[0]" placeholder="An Example">
                    <br>
                </div>
                <div id="con_links_append"></div>
                <input type="button" id="morelinks" onclick="moreConLinks()" value="+" />
            </fieldset>
            <br>
            <fieldset>
            	<legend>Contributor Info</legend>
            	Name or Email:
            	<input type="text" name="user" placeholder="Mentsh (mentsh@velkher.com)"><br>
            	Password:
            	<input type="password" name="pwd">
            </fieldset>
            <input type="submit" value="Expand the Treasury!" style="width:100%;">
            <br>
        </form>

    	<script src="entry_form.js"></script>
	<div id="license" style="float: right; font-size: xx-small; width: 150px; text-align: justify; margin:auto; padding: 10px; display: block;">
		<a rel="license" ref="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="display: block; border-width:0; margin: 0 auto;" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />Except where otherwise noted, content on this site is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
	</div>
    </body>
</html>
