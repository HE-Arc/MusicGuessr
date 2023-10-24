function displaySongsBeginningWith()
{
    let search_string = document.getElementById("search_string_input").value;
    let HTMLRequest = new XMLHttpRequest();
    HTMLRequest.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("songs_list").innerHTML = this.responseText;
        }
    }
    HTMLRequest.open("GET", "/song_beginning_with/" + search_string, true);
    HTMLRequest.send();
}

async function getComparisonWithAnswerSong()
{
    let song_id = document.getElementById("song_id_input").value;
    let HTMLRequest = new XMLHttpRequest();
    HTMLRequest.onreadystatechange = function() {
        console.log("Response: " + this.responseText) ;
        document.getElementById("comparison_list").innerHTML = this.responseText;
    }
    HTMLRequest.open("POST", "/comparison_with_answer_song", true);
    HTMLRequest.setRequestHeader("Content-Type", "application/json");
    HTMLRequest.setRequestHeader("Accept", "application/json");
    HTMLRequest.setRequestHeader("X-CSRF-TOKEN",  document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    HTMLRequest.send(JSON.stringify({song_id: song_id}));


    // let postObject = {
    //     song_id: song_id
    // }
    //
    // fetch('/get_comparison_with_answer_song', {
    //     method: 'POST',
    //     body: JSON.stringify(postObject),
    //     headers: {
    //         'Content-Type': 'application/json',
    //         'Accept': 'application/json',
    //     }
    // }).then(async function(response){
    //     response.json().then(function(data){
    //         console.log("Response: " + data) ;
    //         document.getElementById("comparison_list").innerHTML = data;
    //     })
    // }).catch(function(error) {
    //     console.log(error);
    // })
}

function startGame()
{
    let HTMLRequest = new XMLHttpRequest();
    HTMLRequest.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("songs_list").innerHTML = this.responseText;
        }
    }
    HTMLRequest.open("POST", "/start_game/", true);
    HTMLRequest.setRequestHeader("X-CSRF-TOKEN",  document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    HTMLRequest.send();
}

function endGame()
{
    let HTMLRequest = new XMLHttpRequest();
    HTMLRequest.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("songs_list").innerHTML = this.responseText;
        }
    }

    HTMLRequest.open("POST", "/end_game/", true);
    HTMLRequest.setRequestHeader("X-CSRF-TOKEN",  document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    HTMLRequest.send();
}
