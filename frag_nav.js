var navhtml =  '<ul class="dropdown menu" data-dropdown-menu>';
    navhtml += '<li><a href="index.html">Home</a></li>';
    navhtml += '<li><a href="about.html">About</a></li>';
    navhtml += '<li><a href="contact.html">Contact</a></li>';
    navhtml += '<li><a href="#">Resume</a>';
    navhtml += '  <ul class="menu vertical">';
    navhtml += '    <li><a href="resume.html">Professional Profile</a></li>';
    navhtml += '    <li><a href="resume.html#skills">Skills</a></li>';
    navhtml += '    <li><a href="resume.html#workhistory">Work History</a></li>';
    navhtml += '    <li><a href="resume.html#otherworkhistory">Other Work History</a></li>';
    navhtml += '    <li><a href="resume.html#education">Education &amp; Credentials</a></li>';
    navhtml += '    <li><a href="resume.html#download">Download Resume</a></li>';
    navhtml += '  </ul>';
    navhtml += '</li>';
    navhtml += '<li><a href="clients.html">Clients</a></li>';
    navhtml += '<li><a href="resources.html">Resources</a></li>';
    navhtml += '</ul>';
    
$('.top-bar-left').append(navhtml);