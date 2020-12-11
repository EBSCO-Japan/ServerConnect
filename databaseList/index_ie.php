<!DOCTYPE html>
<?php
  date_default_timezone_set('Asia/Tokyo');
  $jsonFile_direct = 'data/eResourceList.json';

  // get resource list
  $getResourceListJsonData = file_get_contents($jsonFile_direct);
  $resourceList = json_decode($getResourceListJsonData, true);

  // get Proxy
  $getSettingJsonData = file_get_contents('data/settings.json');
  $settingData = json_decode($getSettingJsonData, true);

  $proxy = $settingData['proxy'];
  $GA_ID = $settingData['GA_ID'];

  $result = [];
  $result_en = [];
  $result_local = [];

  foreach($resourceList as $key => $value) {
    $temp_local = [];
    $temp_en = [];
    $isProxy = false;
    $display = true;

    foreach($value as $vkey => $vValue) {
      // put content without languages
      // $i_en = array_search('en', array_keys($value));

      if(!(strcasecmp('local', $vkey) == 0) && !(strcasecmp('en', $vkey) == 0)) {
        $temp_local[$vkey] = $vValue;
        $temp_en[$vkey] = $vValue;
      }

      if(strcasecmp('isProxy', $vkey) == 0) {
        $isProxy = filter_var($vValue, FILTER_VALIDATE_BOOLEAN);
      }
    }

    // get en value and write
    foreach($value['en'] as $ekey => $eValue) {
      $temp_en[$ekey] = $eValue;
    }

    foreach($value['local'] as $tkey => $tValue) {
      $temp_local[$tkey] = $tValue;
    }

    if($isProxy) {
      $temp_en['resourceUrl'] = $proxy.$temp_en['resourceUrl'];
      $temp_local['resourceUrl'] = $proxy.$temp_local['resourceUrl'];
    }

    if (!filter_var($value['expiredChecking'], FILTER_VALIDATE_BOOLEAN) && $value['startDate'] !== '' && $value['expireDate'] !== '') {
      $currentTime = strtotime(date("Y-m-d"));
      $temp_startTime = strtotime($value['startDate']);
      $temp_endTime = strtotime($value['expireDate']);

      if($currentTime > $temp_endTime || $currentTime < $temp_startTime) {
        $display = false;
      }
    }

    if($display) {
      array_push($result_en, $temp_en);
      array_push($result_local, $temp_local);
    }
  }
  
  $result['en'] = $result_en;
  $result['local'] = $result_local;

  $getJsonData = json_encode($result, JSON_UNESCAPED_UNICODE);
?>
<html>
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>資料庫</title>
    <link rel="stylesheet" type="text/css" href="lib/css/index_ie.css"/>
    <script>
      // function isIE() {
      //   ua = navigator.userAgent;
      //   /* MSIE used to detect old browsers and Trident used to newer ones*/
      //   var is_ie = ua.indexOf("MSIE ") > -1 || ua.indexOf("Trident/") > -1;
        
      //   return is_ie; 
      // }
      // if(!isIE()) {
      //   window.location.replace("index.php");
      // }
    </script>
  </head>
<body>
  <section>
    <h1>データベースリスト</h1>
    <div class="browser-notification">
      Internet Explorer（インターネット・エクスプローラー、IE）をご利用のようです。快適にご利用いただくために、WindowsのEdgeや、その他のブラウザをご使用ください。
      <div>※IE10以前のバージョンは、Microsoft社によるサポートが終了しています。
      <a href="https://www.microsoft.com/ja-jp/microsoft-365/windows/end-of-ie-support?rtc=1" target="_blank">"古いバージョンの Internet Explorer のサポート終了"</a></div>
      <ul>
        <li>
          <a href="https://www.google.com/intl/ja_jp/chrome/" target="_blank">【Google Chromeをダウンロード】</a>
        </li>
        <li>
          <a href="https://www.mozilla.org/ja/firefox/new/" target="_blank">【Firefoxをダウンロード】</a>
        </li>
        <li>
          <a href="https://www.mozilla.org/ja/firefox/new/" target="_blank">【Edgeをダウンロード】</a>
        </li>
      </ul>
    </div>
  </section>
  <section>
    <div>
      <div class="search-wrap">
        <div class="search-frame">
          <input type="text" class="search" placeholder="リソースを検索" id="searchBoxArea" onkeyup="searchKeyword()"/>
        </div>
      </div>
      <div class="content-field" id="databaseList">
        <article>
          <ol class="list" id="resourceList">
          </ol>
          <ul class="pagination"></ul>
        </article>
      </div>
    </div>
  </section>
  <footer class="footer">
    <img src="img/logo_white.svg">
    <p>© 2020 EBSCO Industries, Inc. All rights reserved</p>
  </footer>
  <div class="mask-dia" id="dialogue" v-if="show" :class="{ show: show }">
    <div class="cover" @click="closeDialogue()"></div>
    <div class="dialogue-message-frame">
      <div class="dialogue-head">
        <h4>{{dialogueMessage.title}}</h4>
        <img src="img/icon/closeWhite.svg" class="close" @click="closeDialogue">
      </div>
      <div class="dialogue-body">
        <div class="content" v-html="dialogueMessage.content"></div>
      </div>
    </div>
  </div>
</body>
</html>
<script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
<script src="lib/js/basicParameters.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-i18n/8.15.3/vue-i18n.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $GA_ID; ?>"></script>
<script>
  const GA_ID = '<?php echo $GA_ID; ?>';
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', GA_ID, 'auto');
  ga('send', 'pageview');
</script>

<script type="text/javascript">
  var dataList = <?php echo $getJsonData; ?>;

  var ary_dataList = new Array();
  ary_dataList['en'] = dataList.en;
  ary_dataList['local'] = dataList.local;

  var contactList

  function changeRsourceListLanguage() {
    contactList.clear();

    let index_numbering = 1;
    ary_dataList['local'].forEach(function (res, index) {
      res['numbering'] = index_numbering;
      index_numbering++;
      contactList.add(res);
    })
  }

  function resetNumbering() {
    let count = 1;
    contactList.items.forEach(function (item) {
      if(contactList.searched === item.found && contactList.filtered === item.filtered) {
        let tempObj = Object.assign({}, item['_values']);
        tempObj['numbering'] = count;
        item.values(tempObj);
        count++;
      }
    })
  }

  function sortBy(sortName, options) {
    contactList.sort(sortName, options);
    resetNumbering();
  }

  let listTitles = [];
  listTitles['local'] = {
    "resourceName": 'リソース名',
    "resourceUrlTitle": 'リンク',
    "resourceUrlDisplayName": 'クリック',
    "isProxy": 'プロキシ',
    "resourceType": 'リソースタイプ',
    "startDate": '開始日',
    "expireDate": '終了日',
    "faculty": '学部',
    "department": '学科',
    "subject": 'サブジェクト',
    "category": '分類',
    "type": 'タイプ',
    "publisher": '出版社',
    "language": '言語',
    "resourceDescribe": 'リソースの説明',
    "relevanceUrlDescribe": '関連URL詳細',
    "moreDetail": '詳細'
  }


  function genDatalistStructure() {
    let ul_Dom = document.getElementById("resourceList");
    
    ul_Dom.innerHTML = '';

    let ary_lang = 'local';

    // create li and append to ul
    ary_dataList['local'].forEach(function (res, index) {
      let li_dom = document.createElement('li');

      let newLabel = document.createElement('label');
      newLabel.setAttribute("for", 'checkbox_' + index);
      newLabel.innerHTML = '<div class="numbering">'+(index + 1)+'</div>\
                            <div class="row">\
                              <div class="title">'+listTitles['local'].resourceName+'</div>\
                              <div class="resourceName">'+res.resourceName+'</div>\
                            </div>\
                            <div class="row">\
                              <div class="title">'+listTitles['local'].resourceType+'</div>\
                              <div class="resourceType">'+res.resourceType+'</div>\
                            </div>\
                            <div class="row">\
                              <div class="title">'+listTitles['local'].subject+'</div>\
                              <div class="subject">'+res.subject+'</div>\
                            </div>\
                            <div class="row">\
                              <div class="title">'+listTitles['local'].resourceUrlTitle+'</div>\
                              <div class="resourceUrl">\
                                <a href="javascript:directTo(\''+res.uuid+'\', \''+res.resourceUrl+'\')"><img src="img/icon/link.svg" alt="link" title="link"/>'+listTitles['local'].resourceUrlDisplayName+'</a>\
                              </div>\
                            </div>';

      let newCheckBox = document.createElement('input');
      newCheckBox.type = 'checkbox';
      newCheckBox.className = 'collapse-checkbox';
      newCheckBox.id = 'checkbox_' + index;

      let box_div_dom = document.createElement('div');
      box_div_dom.className = 'box';
      box_div_dom.innerHTML = '<div class="row">\
                                <div class="title">'+listTitles['local'].startDate+'</div>\
                                <div class="startDate">'+res.startDate+'</div>\
                              </div>\
                              <div class="row">\
                                <div class="title">'+listTitles['local'].expireDate+'</div>\
                                <div class="expireDate">'+res.expireDate+'</div>\
                              </div>\
                              <div class="row">\
                                <div class="title">'+listTitles['local'].faculty+'</div>\
                                <div class="faculty">'+res.faculty+'</div>\
                              </div>\
                              <div class="row">\
                                <div class="title">'+listTitles['local'].department+'</div class="title">\
                                <div class="type">'+res.department+'</div>\
                              </div>\
                              <div class="row">\
                                <div class="title">'+listTitles['local'].category+'</div>\
                                <div class="category">'+res.category+'</div>\
                              </div>\
                              <div class="row">\
                                <div class="title">'+listTitles['local'].publisher+'</div class="title">\
                                <div class="publisher">'+res.publish+'</div>\
                              </div>\
                              <div class="row">\
                                <div class="title">'+listTitles['local'].language+'</div class="title">\
                                <div class="language">'+res.language+'</div>\
                              </div>\
                              <div class="row">\
                                <div class="title">'+listTitles['local'].resourceDescribe+'</div class="title">\
                                <div class="resourceDescribe">'+res.resourceDescribe+'</div>\
                              </div>\
                              <div class="row">\
                                <div class="title">'+listTitles['local'].relevanceUrl+'</div class="title">\
                                <div class="relevanceUrlDescribe"><a href="'+res.relevanceUrlDescribe+'" target="_blank">'+res.relevanceUrlDescribe+'</a></div>\
                              </div>\
                              <div class="row hide">\
                                <div class="title">注音</div class="title">\
                                <div class="zhuyin">'+res.zhuyin+'</div>\
                              </div>\
                              <div class="row hide">\
                                <div class="title">筆劃</div class="title">\
                                <div class="strokes">'+res.strokes+'</div>\
                              </div>\
                              <div class="row hide">\
                                <div class="title">アルファベット</div class="title">\
                                <div class="englishAlphabet">'+res.englishAlphabet+'</div>\
                              </div>';
      let moreLabel = document.createElement('label');
      moreLabel.setAttribute("for", 'checkbox_' + index);
      moreLabel.className = 'more-detail';
      moreLabel.innerHTML = '<div class="more"><img src="img/icon/expand_more.svg" alt="expand" title="expand"/></div><div class="less"><img src="img/icon/expand_less.svg" alt="less" title="less"/></div>';

      li_dom.appendChild(newLabel);
      li_dom.appendChild(newCheckBox);
      li_dom.appendChild(box_div_dom);
      li_dom.appendChild(moreLabel);
      ul_Dom.appendChild(li_dom);
    });
    // if(local){
    //   window.setTimeout(( function () {
    //     // contactList.update();
    //     contactList.reIndex();
    //   } ), 500);
    // }
  }
  genDatalistStructure();

  function directTo(id, url) {
    window.open(url, '_blank');
    $.ajax({
      url: apiPath+'/processLogClick.php',
      type: 'POST',
      data: {
        directionID: id
      },
      error: function(jqXHR, exception) {
        //use url variable here
        console.log(jqXHR);
        console.log(exception);
      },
      success: function(res) {
        console.log(res);
      }
    });
  }
  function checkSessionExist() {
    return new Promise(function (resolve, reject) {
      $.ajax({
        url: apiPath+'/verifyUserSession.php',
        type: 'GET',
        xhrFields: {
          withCredentials: true
        },
        error: function(jqXHR, exception) {
          console.log(jqXHR);
          console.log(exception);
        },
        success: function(res) {
          if(res.type === 'pass') {
            resolve(true);
          } else {
            resolve(false);
          }          
        }
      });
    });
  }
  function errorMsg (code) {
    switch (code) {
      case 1:
        alert('そのようなリンクはありません。');
        break;
      default:
        alert('不明なメッセージ');
    }
  }

  function initAndAddClickedClass(anchor) {
    document.querySelectorAll('.link-field > a').forEach(function (res) {
      res.classList.remove("clicked");

      if (anchor !== undefined) {
        anchor.className = 'clicked';
      } else {
        document.getElementById('searchTotal').className = 'clicked';
      }
    });
  }

  function searchKeyword() {
    searchBy(document.getElementById("searchBoxArea").value);
  }
  function searchBy(term, field) {
    if(field !== undefined) {
      contactList.search(term, [field]);
    } else {
      contactList.search(term);
    }
    resetNumbering();
  }
  function searchAll(anchor) {
    initAndAddClickedClass();

    // remove all condition of search
    contactList.search();

    // remove all conditions of filter
    contactList.filter();
    resetNumbering();
  }

  document.addEventListener("DOMContentLoaded", function(event) {
    // Init list
    var options = {
      valueNames: ['numbering', 'resourceName', 'resourceType', 'startDate', 'expireDate', 'faculty', 'subject', 'category', 'type', 'publisher', 'language', 'resourceDescribe', 'zhuyin', 'strokes', 'englishAlphabet'],
      page: 20,
      pagination: {
        innerWindow: 1,
        outerWindow: 1
      }
      // indexAsync: true
    };
    contactList = new List('databaseList', options);

    let url_string = window.location.href;
    let url = new URL(url_string);
    let param_keyword = url.searchParams.get("keyword");
    
    // if param have value, set the keyword to search-box
    if(param_keyword) {
      filterField.setKeyword(param_keyword);
    }
  });
</script>
