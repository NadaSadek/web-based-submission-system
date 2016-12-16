fields = 0;
function addInput() {
if (fields != 10) {
document.getElementById('text').innerHTML += "<input type='text' value='' name='t' /><br />";
fields += 1;
document.getElementById('counter').innerHTML = fields;

} else {
document.getElementById('text').innerHTML += "<br />Only 10 upload fields allowed.";
document.form.add.disabled=true;
}
}
