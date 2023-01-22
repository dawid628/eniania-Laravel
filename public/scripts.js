
// Scrollbar on bottom
function scrollbarBottom(){
    var element = document.getElementById('message-scroll');
    element.scrollTop = element.scrollHeight;
  }

  // Sending message without refreshing page
  function sendMessage(){
    document.querySelector('#send-form').addEventListener('submit', (e) => {
      e.preventDefault();
      var formData = new FormData(e.target);
      fetch("{{ route('send-message') }}", { 
      method: 'POST',
      body: formData
      }).then(() => document.getElementById('msgInput').value = '');
    });
  }

  //Rating stars
function fillStars(id) {
    var element = document.getElementById(id);
    var value = id;
    var input = document.getElementById('starInput');
    input.setAttribute('value', value);
    for (var i = 1; i <= 5; i++) {
        if(i <= value){
            document.getElementById(i).style.color = "yellow";
        }
        else{
            document.getElementById(i).style.color = null; 
        }
    }
} 

function messageMyself(){
  alert('Nie możesz wysyłac wiadomości do siebie samego.')
}