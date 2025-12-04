<!DOCTYPE HTML>
<html>

<head>
  <title>PhotoArtWork</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <!-- stylesheets -->
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/light.css" rel="stylesheet" type="text/css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">

    <!-- begin header -->
    <header>
      <div id="logo"><h1>Kaan Nuri <a href="#">Soylu</a></h1></div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li><a href="index.html" data-lang="anasayfa">anasayfa</a></li>
          <li><a href="about.html" data-lang="hakkımda">hakkımda</a></li>
          <li><a href="#" data-lang="projeler/galeri">projeler/galeri</a>
            <ul>
              <li><a href="portfolio_one.html" data-lang="projeler">projeler</a></li>
              <li><a href="portfolio_two.html" data-lang="galeri">galeri</a></li>
            </ul>
          </li>
        
          <li class="selected"><a href="contact.html" data-lang="iletişim">iletişim</a></li>
          <li><a href="javascript:void(0)" id="langToggle" data-lang="lang-toggle">TR</a></li>
        </ul>
      </nav>
    </header>
    <!-- end header -->

    <!-- begin content -->
    <div id="site_content">
      <div id="left_content">
        <h1 data-lang-tr="İletişim" data-lang-en="Contact">İletişim</h1>
        <p data-lang-tr="Merhaba, bu iletişim formu aracılığıyla benimle iletişime geçin." data-lang-en="Say hello, using this contact form.">İletişim formu aracılığıyla benimle iletişime geçin.</p>
        <?php
          // This PHP Contact Form is offered &quot;as is&quot; without warranty of any kind, either expressed or implied.
          // David Carter at www.css3templates.co.uk shall not be liable for any loss or damage arising from, or in any way
          // connected with, your use of, or inability to use, the website templates (even where David Carter has been advised
          // of the possibility of such loss or damage). This includes, without limitation, any damage for loss of profits,
          // loss of information, or any other monetary loss.

          // Set-up these 3 parameters
          // 1. Enter the email address you would like the enquiry sent to
          // 2. Enter the subject of the email you will receive, when someone contacts you
          // 3. Enter the text that you would like the user to see once they submit the contact form
          $to = 'knsoylu2001@gmail.com';
          $subject = 'Sitemden iletişim bilgisi';
          $contact_submitted = 'İletşim bilgilerin yollandı.';

          // Do not amend anything below here, unless you know PHP
          function email_is_valid($email) {
            return preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i',$email);
          }
          if (!email_is_valid($to)) {
            echo '<p style="color: red;">You must set-up a valid (to) email address before this contact page will work.</p>';
          }
          if (isset($_POST['contact_submitted'])) {
            $return = "\r";
            $youremail = trim(htmlspecialchars($_POST['your_email']));
            $yourname = stripslashes(strip_tags($_POST['your_name']));
            $yourmessage = stripslashes(strip_tags($_POST['your_message']));
            $contact_name = "Name: ".$yourname;
            $message_text = "Message: ".$yourmessage;
            $user_answer = trim(htmlspecialchars($_POST['user_answer']));
            $answer = trim(htmlspecialchars($_POST['answer']));
            $message = $contact_name . $return . $message_text;
            $headers = "From: ".$youremail;
            if (email_is_valid($youremail) && !eregi("\r",$youremail) && !eregi("\n",$youremail) && $yourname != "" && $yourmessage != "" && substr(md5($user_answer),5,10) === $answer) {
              mail($to,$subject,$message,$headers);
              $yourname = '';
              $youremail = '';
              $yourmessage = '';
              echo '<p style="color: blue;">'.$contact_submitted.'</p>';
            }
            else echo '<p style="color: red;">Please enter your name, a valid email address, your message and the answer to the simple maths question before sending your message.</p>';
          }
          $number_1 = rand(1, 9);
          $number_2 = rand(1, 9);
          $answer = substr(md5($number_1+$number_2),5,10);
        ?>
        <form id="contact" action="contact.php" method="post">
          <div class="form_settings">
            <p><span data-lang-tr="Ad" data-lang-en="Name">Ad</span><input class="contact" type="text" name="your_name" value="<?php echo $yourname; ?>" /></p>
            <p><span data-lang-tr="Email Adresi" data-lang-en="Email Address">Email Adresi</span><input class="contact" type="text" name="your_email" value="<?php echo $youremail; ?>" /></p>
            <p><span data-lang-tr="Mesaj" data-lang-en="Message">Mesaj</span><textarea class="contact textarea" rows="5" cols="50" name="your_message"><?php echo $yourmessage; ?></textarea></p>
            <p style="line-height: 1.7em;" data-lang-tr="Spam'ı önlemeye yardımcı olmak için bu soruya cevap verin:" data-lang-en="To help prevent spam, please enter the answer to this question:">Spam'ı önlemeye yardımcı olmak için bu soruya cevap verin:</p>
            <p><span><?php echo $number_1; ?> + <?php echo $number_2; ?> = ?</span><input type="text" name="user_answer" /><input type="hidden" name="answer" value="<?php echo $answer; ?>" /></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="contact_submitted" value="send" /></p>
          </div>
        </form>
      </div>
      <div id="right_content">
        <img src="images/contact.jpg" width="450" height="450" title="contact" alt="contact" />
      </div>
    </div>
    <!-- end content -->

    <!-- begin footer -->
    <footer>
      <p>Copyright &copy; 2012 PhotoArtWork. All Rights Reserved. <a href="http://www.css3templates.co.uk">Design from css3templates.co.uk</a>.</p>
      <p><img src="images/twitter.png" alt="twitter" />&nbsp;<img src="images/facebook.png" alt="facebook" />&nbsp;<img src="images/rss.png" alt="rss" /></p>
    </footer>
    <!-- end footer -->

  </div>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript" src="js/language.js"></script>
  <!-- initialise sooperfish menu -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
      setupLanguageToggle();
    });
  </script>
</body>
</html>
