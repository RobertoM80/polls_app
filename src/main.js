var x;
var len;
var str;
var obj_opt = {};
var arr_opt = [];
var arr_votes = [];
var arr_hex_color = [];
var css_color_names_and_hex = {"aliceblue":"#f0f8ff","antiquewhite":"#faebd7","aqua":"#00ffff","aquamarine":"#7fffd4","azure":"#f0ffff",
    "beige":"#f5f5dc","bisque":"#ffe4c4","black":"#000000","blanchedalmond":"#ffebcd","blue":"#0000ff","blueviolet":"#8a2be2","brown":"#a52a2a","burlywood":"#deb887",
    "cadetblue":"#5f9ea0","chartreuse":"#7fff00","chocolate":"#d2691e","coral":"#ff7f50","cornflowerblue":"#6495ed","cornsilk":"#fff8dc","crimson":"#dc143c","cyan":"#00ffff",
    "darkblue":"#00008b","darkcyan":"#008b8b","darkgoldenrod":"#b8860b","darkgray":"#a9a9a9","darkgreen":"#006400","darkkhaki":"#bdb76b","darkmagenta":"#8b008b","darkolivegreen":"#556b2f",
    "darkorange":"#ff8c00","darkorchid":"#9932cc","darkred":"#8b0000","darksalmon":"#e9967a","darkseagreen":"#8fbc8f","darkslateblue":"#483d8b","darkslategray":"#2f4f4f","darkturquoise":"#00ced1",
    "darkviolet":"#9400d3","deeppink":"#ff1493","deepskyblue":"#00bfff","dimgray":"#696969","dodgerblue":"#1e90ff",
    "firebrick":"#b22222","floralwhite":"#fffaf0","forestgreen":"#228b22","fuchsia":"#ff00ff",
    "gainsboro":"#dcdcdc","ghostwhite":"#f8f8ff","gold":"#ffd700","goldenrod":"#daa520","gray":"#808080","green":"#008000","greenyellow":"#adff2f",
    "honeydew":"#f0fff0","hotpink":"#ff69b4",
    "indianred ":"#cd5c5c","indigo":"#4b0082","ivory":"#fffff0","khaki":"#f0e68c",
    "lavender":"#e6e6fa","lavenderblush":"#fff0f5","lawngreen":"#7cfc00","lemonchiffon":"#fffacd","lightblue":"#add8e6","lightcoral":"#f08080","lightcyan":"#e0ffff","lightgoldenrodyellow":"#fafad2",
    "lightgrey":"#d3d3d3","lightgreen":"#90ee90","lightpink":"#ffb6c1","lightsalmon":"#ffa07a","lightseagreen":"#20b2aa","lightskyblue":"#87cefa","lightslategray":"#778899","lightsteelblue":"#b0c4de",
    "lightyellow":"#ffffe0","lime":"#00ff00","limegreen":"#32cd32","linen":"#faf0e6",
    "magenta":"#ff00ff","maroon":"#800000","mediumaquamarine":"#66cdaa","mediumblue":"#0000cd","mediumorchid":"#ba55d3","mediumpurple":"#9370d8","mediumseagreen":"#3cb371","mediumslateblue":"#7b68ee",
    "mediumspringgreen":"#00fa9a","mediumturquoise":"#48d1cc","mediumvioletred":"#c71585","midnightblue":"#191970","mintcream":"#f5fffa","mistyrose":"#ffe4e1","moccasin":"#ffe4b5",
    "navajowhite":"#ffdead","navy":"#000080",
    "oldlace":"#fdf5e6","olive":"#808000","olivedrab":"#6b8e23","orange":"#ffa500","orangered":"#ff4500","orchid":"#da70d6",
    "palegoldenrod":"#eee8aa","palegreen":"#98fb98","paleturquoise":"#afeeee","palevioletred":"#d87093","papayawhip":"#ffefd5","peachpuff":"#ffdab9","peru":"#cd853f","pink":"#ffc0cb","plum":"#dda0dd","powderblue":"#b0e0e6","purple":"#800080",
    "red":"#ff0000","rosybrown":"#bc8f8f","royalblue":"#4169e1",
    "saddlebrown":"#8b4513","salmon":"#fa8072","sandybrown":"#f4a460","seagreen":"#2e8b57","seashell":"#fff5ee","sienna":"#a0522d","silver":"#c0c0c0","skyblue":"#87ceeb","slateblue":"#6a5acd","slategray":"#708090","snow":"#fffafa","springgreen":"#00ff7f","steelblue":"#4682b4",
    "tan":"#d2b48c","teal":"#008080","thistle":"#d8bfd8","tomato":"#ff6347","turquoise":"#40e0d0",
    "violet":"#ee82ee",
    "wheat":"#f5deb3","white":"#ffffff","whitesmoke":"#f5f5f5",
    "yellow":"#ffff00","yellowgreen":"#9acd32"};
var css_color_names = ["LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral",
                   "LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon",
                   "LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime",
                   "LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple",
                   "MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue",
                   "MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed",
                   "Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink",
                   "Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen",
                   "SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue",
                   "Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen",
                   "AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond",
                   "Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue",
                   "Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen",
                   "DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen",
                   "DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue",
                   "DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro",
                   "GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed",
                   "Indigo","Ivory","Khaki","Lavender"];

// function shuffle(array) {
// var currentIndex = array.length, temporaryValue, randomIndex;

// // While there remain elements to shuffle...
// while (0 !== currentIndex) {

// // Pick a remaining element...
// randomIndex = Math.floor(Math.random() * currentIndex);
// currentIndex -= 1;

// // And swap it with the current element.
// temporaryValue = array[currentIndex];
// array[currentIndex] = array[randomIndex];
// array[randomIndex] = temporaryValue;
// }

// return array;
// }

function arr_colors(array_label, css_color_names){
    var arr = [];
    var len = array_label.length;
    for (var i = 0; i <= len; i++) {
        arr.push(css_color_names[Math.floor(Math.random()*css_color_names.length)]);
    };
    return arr;
}

function return_hex(css_color_names_and_hex) {
    for(var color in css_color_names_and_hex) {
        arr_hex_color.push(css_color_names_and_hex[color]);
    }
}

return_hex(css_color_names_and_hex);

x = document.getElementById("options");
len = document.getElementById("options").options.length;


$.getJSON("json_data_chart.php", function(json){
  if (json) {
    for (var prop in json) {
      //console.log(obj_opt[sony]);
      if(!obj_opt.hasOwnProperty(json[prop].choice)) {
          var answers = json[prop].choice;
          obj_opt[answers] =  0;
      }
    };

    for (var i = 0; i < len; i++) {
        obj_opt[x.options[i].value]= 0;

    };

     console.log(json, '--', obj_opt);
    for (var prop in json) {
        // if(!obj_opt.hasOwnProperty(json[prop].choice)) {
        //     var answers = json[prop].choice;
        //     obj_opt[answers] = 0;
        // } 
        
            var answers = json[prop].choice;
            obj_opt[answers] = json[prop].count;
        
    };
   }

  for (var option in obj_opt) {
    arr_opt.push(option);
    arr_votes.push(obj_opt[option]);
  }

var colors = arr_colors(arr_opt, arr_hex_color);
var ctx = document.getElementById("myChart").getContext("2d");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data:{
        labels: arr_opt,
        datasets: [
            {
                data: arr_votes,
                backgroundColor: colors,
                hoverBackgroundColor: 'rgba(119,229,115,0.9)',
            }]
    },
    options: {
        legend: {
            display: true,
            position: 'top',
            labels: {
                fontColor: '#FFFCFF',
                fontSize: 14,
                boxWidth: 30
            },
            onClick: function(){
                return true;
            }
        },
        responsive: true,
        animation: {
            animateScale: true
        },

    }
});
});

//show extra-option form

$("form#chose").submit(function(event) {
  //event.preventDefault();
  console.log($('form#chose option:selected').val());
  var selected = $('form#chose option:selected').val();
  if (selected === 'extra_option') {
    event.preventDefault();
    $('form#extra').removeClass('hide');   
  };
});

$("form#extra").submit(function(event) {
    //event.preventDefault();
    console.log($('input[name=extra]').val());
    var new_value = $('input[name=extra]').val();
    $("select#options").prepend('<option>' + new_value +'</option>');
    $('form#extra').addClass('hide');
    $('.option_added').html('<p style="background-color:#96002B">your new option has been updated!</p>');   
});





