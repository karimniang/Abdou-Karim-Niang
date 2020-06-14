<div class="contant">
  <div id="scroller" class="lister-question">
    <div id="myscro" style="max-height: 260px;overflow: scroll;">

    </div>
  </div>
</div>
<?php
//for ($i = 0; $i < count($dataQuestions); $i++) {
//$dataQuestions[$i]['bonne'] = explode(";", $dataQuestions[$i]['bonne']);
//$dataQuestions[$i]['tous'] = explode(";", $dataQuestions[$i]['tous']);
//}
?>
<script>
  $(document).ready(function() {
    let offset = 0;
    const lien = $('#myscro');
    $.ajax({
      type: "POST",
      url: "http://localhost/Projet_S.A/quizz_sa_db/bds/ls-question.php",
      data: {
        limit: 5,
        offset: offset
      },
      dataType: "JSON",
      success: function(data) {
        lien.html('')
        scrollData(data, lien);
        offset += 5
      }
    });

    //  Scroll
    //const scrollZone = $('#scrollZone')
    lien.scroll(function() {
      //console.log(lien[0].clientHeight)
      const st = lien[0].scrollTop;
      const sh = lien[0].scrollHeight;
      const ch = lien[0].clientHeight;

      //console.log(st, sh, ch);

      if (sh - st <= ch) {
        $.ajax({
          type: "POST",
          url: "http://localhost/Projet_S.A/quizz_sa_db/bds/ls-question.php",
          data: {
            limit: 5,
            offset: offset
          },
          dataType: "JSON",
          success: function(data) {

            scrollData(data, lien);
            offset += 5;
          }
        });
      }

    })
    $(".btnSupp").click(function() {
      alert('kk');
      tab = $(this).attr("bing").split("_");
      id = tab[1];
      console.log(id);
    });
  });





  function scrollData(data, lien) {
    var dataLen = data.length;
    for (var i = 0; i < dataLen; i++) {
      var question = data[i]["question"];
      var score = data[i]["score"];
      var type = data[i]["type"];
      var id = data[i]["id"];
      var tous = data[i]["tous"];
      var bonne = data[i]["bonne"];
      lien.append("<ul id='ul_" + i + "'></ul>");
      $("#ul_" + i).append("<li style='margin-bottom:5px'>" + question + " <div style='margin-bottom:5px'>" + score + "pts </div></li>");
      if (type === "simple") {
        for (var j = 0; j < tous.length; j++) {
          var tt = tous[j];
          if (bonne.includes(tt)) {
            $("#ul_" + i).append("<input type='radio' checked>" + tt);
          } else {
            $("#ul_" + i).append("<input type='radio'>" + tt);
          }
        }
      } else if (type === "multiple") {
        for (var j = 0; j < tous.length; j++) {
          var tt = tous[j];
          if (bonne.includes(tt)) {
            $("#ul_" + i).append("<input type='checkbox' checked>" + tt);
          } else {
            $("#ul_" + i).append("<input type='checkbox'>" + tt);
          }
        }
      } else if (type === "text") {
        $("#ul_" + i).append("<input type='text' value='" + bonne + "'>");
      }
      $("#ul_" + i).append("<button style='margin-left:10px' class='btnSupp' bing='mon_" + id + "' type='button' >Supp</button>");
    }
  }
</script>