
var fragment = new DocumentFragment();
var footer = document.createElement("p");
footer.id = "footertext";

fragment.appendChild(footer);

footer.textContent = "\u00a9\u00A02018\u00A0Slycoder.com | ";
footer.textContent += "Westminster,\u00A0Co.\u00A080260 |    ";
footer.textContent += "cell:\u00A0(720)\u00A0364\u20118011 | e\u2011mail:\u00A0";

// append footer to DOM
var putinfooter = document.querySelector('footer');
putinfooter.appendChild(fragment);
// add link
var html = "<a href='mailto:sly@slycoder.com'>Sly@SlyCoder.com</a>"
$('#footertext').append(html);