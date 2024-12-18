<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    {% include 'header.tpl' %}
    
    <div class="main-content center">
        {% include content_template_name %}
        {% include 'sidebar.tpl' %}
    </div>
   
    {% include 'footer.tpl' %}
</body>
</html>

