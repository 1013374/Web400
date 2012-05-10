function getHash(tokens)
{
	var id = document.getElementById('users').value;
	for (token in tokens) {
		if (token[0] == id) {
			$('#transferhash').val(token[1]);
		}
	}
	
}
