<html><head>

<script type="text/javascript" src="lib/jquery-1.10.2.min.js"></script>
 <script type="text/javascript" >
    $(function() {
        $("#Submit").click(function(e) {
            e.preventDefault();
            var contacttype = $("#contacttype").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var phone = $("#phone").val();
            var comment = $("#comment").val();
            var dataString = 'name='+ name + '& email=' + email + '& phone=' + phone + '& comment=' + comment;

            if(name=='')
            {
                alert(dataString);
            }
            else
            {
					alert(dataString);
            }
            return false;
        });
    });
    </script>
    </head>
    <body>

<form action="" method="post" id="contact_form">
    <select id="contacttype" name="contactform">
        <option selected="selected" value="Select">Select</option>
        <option value="Franchisee">Franchisee</option>
        <option value="Enquiry">Enquiry</option>
        <option value="Feedback">Feedback</option>
        <option value="Complaint">Complaint</option>
    </select><br>
    <input type="text" name="name" placeholder="Name"><br>
    <input type="text" name="email" placeholder="Email"><br>
    <input type="text" name="phone" placeholder="Phone"><br>
    <textarea name="comment" placeholder="Comment"></textarea><br>
    <input type="submit" name="submit" id="Submit" >
    <span class="error" style="display:none"> Please Enter Valid Data</span>
    <span class="success" style="display:none"> Registration Successfully</span>
</form>

</body></html>