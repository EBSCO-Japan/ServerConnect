const messages = {
  en: {
    message: {
      chooseLanguage:'Language',
      header_logout: 'Logout',
      header_expiryResourceSetting: 'Expiry Resource',
      // index page
      h1_resource_list: 'Database List',
      index_total: 'ALL',
      index_show_all: 'Show All',
      index_atoz: 'A to Z',
      index_zhuyin: 'Zhu Yin',
      index_strokes: 'Strokes',
      index_sort: 'Sort by',
      index_bulletin: 'Bulletin',
      index_more: 'More',
      index_placeholder_text: 'Search Resource',
      index_popular_frameTitle: 'Popular Resources',
      index_popular_title: 'Resource Name',
      index_popular_clickAmount: 'Clicks',
      index_commonly_title: 'Commonly Resources',
      adminIndex_verifyCode: 'Verify Code',
      // All Latest News page
      h1_all_latestNews: 'Latest News',
      // admin index page
      adminIndex_account: 'Account',
      adminIndex_password: 'Password',
      adminIndex_account_pwd_rror: 'Invalid Account/Password',
      // Resource Management page
      h1_resource_management: 'Resource Setting',
      resource_resourceName: 'Title',
      resource_resourceType: 'Type',
      resource_faculty: 'School',
      resource_department: 'Department',
      resource_subject: 'Subject',
      resource_category: 'Category',
      resource_publisher: 'Publisher',
      resource_language: 'Language',
      resource_resourceDescribe: 'Description',
      resource_relevanceUrlDescribe: 'Information Link Name',
      resource_startDate: 'Start Day',
      resource_expireDate: 'End Day',
      resource_isProxy: 'Apply Proxy/Redirector',
      resource_resourceUrl: 'Access Link',
      resource_relevanceUrl: 'Information Link',
      resource_btn_modify: 'Modify',
      resource_btn_add: 'Add',
      resource_expired_display: 'Display this resource when expired',
      resource_stop_checking_expiring: 'Stop Checking',
      // setting page
      h1_settings: 'Settings',
      generalSetting: 'General Settings',
      tools: 'Tool Kits',
      build_alphabet_stokes: 'Rebuild AtoZ index',
      setting_ga: 'Google Analytics Tracking ID',
      setting_localization: 'Show Language Option',
      setting_update_the_account_and_password: 'Update the account and password',
      setting_account_info: 'Account Information',
      setting_password_wronging: 'Your password is wrong',
      setting_password_not_matching: 'Your password and confirm password are not match',
      setting_import_csv_data: 'Import resource list (txt file)',
      setting_proxy: 'Proxy/Redirector Prefix URL',
      setting_total_resources: 'Total Resources',
      setting_show_popular_resources: 'The number of Popular resources to show(0 means won\'t show on front-page)',
      setting_show_database_number: 'The number of resources to show',
      setting_exportDatabaseFile: 'Export Database List',
      setting_exportContentIncludeHtml: 'Export content include HTML',
      // latest news management page
      h1_latestNews: 'News Management',
      latest_form_setting: 'News Block Settings',
      latest_form_name: 'Block Title',
      latest_form_number_of_showing: 'How many news to show in the block',
      latest_publish_date: 'Date',
      latest_publish_title: 'Title',
      latest_publish_content: 'Content',
      latest_hot_news: 'Hot News',
      latest_hot_news_show_or_not_show: 'Show',
      latest_hot_news_message: 'Choose Message',
      latest_hot_news_message_select: 'Select',
      // expiry checking page
      h1_expiring: 'Expiry Management',
      expiring_turn_on_the_feature: 'Turn on the feature',
      expiring_days_before_expiry: 'Days before expiry',
      expiring_resource_status: 'Resource Status',
      expiring_no_resource: 'No Resource',
      // Subject management page
      h1_subject: 'Facets Management',
      subject_setting: 'Facets Management',
      subject_title: 'Facet Title',
      subject_name: 'Item',
      subject_create_subject: 'New Item',
      subject_create_subject_item: 'Add New Facet Block',
      subject_facet_field: 'Facet Field',
      // identity management page
      h1_identity: 'Identity Management',
      identity_validateIdentity: 'Identity Validate feature',
      identity_addNewItem: 'Add New Item',
      identity_title_department: 'Department',
      identity_title_Identity: 'Identity',
      select_options: 'Options',
      select_sameLevel: 'Add item for same level',
      select_nextLevel: 'Add item for next level',
      // Clicking Report page
      h1_clickingReport: 'Clicking Report',
      clickingReport_start_date: 'Start Day',
      clickingReport_end_date: 'End Day',
      clickingReport_display_by: 'Display by',
      clickingReport_day: 'Day',
      clickingReport_month: 'Month',
      clickingReport_departmemnt: 'Department',
      clickingReport_userIdentity: 'User Identity',
      clickingReport_download_the_report: 'Report Download',
      // commonly resource
      h1_commonlyResource: 'Commonly Resource Management',
      commonlyResource_showOnFrontStage: 'Show on front stage',
      commonlyResource_noResource: 'The commonly list has no resource inside',
      commonlyResource_resourceList: 'ALL Resources',
      commonlyResource_commonResourceList: 'Commonly Resource List',
      // dialogue
      dialogue_title: 'Title',
      dialogue_title_warning: 'Warning',
      dialogue_title_info: 'Info',
      dialogue_title_actpwd: 'Account and Password Setting',
      dialogue_title_account: 'Account',
      dialogue_title_old_password: 'Old Password',
      dialogue_title_new_password: 'New Password',
      dialogue_title_confirm_new_password: 'Confirm New Password',
      dialogue_content_expired: 'The credential has expired, please log in again',
      dialogue_content_addSuccess: 'Added',
      dialogue_content_updateSuccess: 'Updated',
      dialogue_content_deleteSuccess: 'Deleted',
      dialogue_content_account_updateSuccess: 'Your account has updated successfully, please re-login',
      dialogue_content_logout: 'Log out successfully',
      dialogue_content_import_successful: 'Import Successful',
      dialogue_content_databaseUpload: 'The database list will be overwritten. Are you sure to upload it',
      dialogue_content_deleteNews: 'Are you sure to delete this News',
      // placeholder
      placeholder_searchResource: 'Search Resource',
      // button
      btn_add: 'Add',
      btn_copy: 'Copy',
      btn_recover: 'Recover',
      btn_update: 'Update',
      btn_execute: 'Execute',
      btn_confirm: 'Confirm',
      btn_cancel: 'Cancel',
      btn_search: 'Search',
      btn_close: 'Close',
      btn_modify: 'Modify',
      btn_download_report: 'Download Report',
      btn_sort_1: 'Resource Name',
      btn_sort_2: 'Language',
      btn_sort_3: 'Publisher',
      btn_sort_4: 'Category',
      btn_login: 'Login',
      btn_change: 'Change',
      // selector
      selector_yes: 'yes',
      selector_no: 'no',
      // resourceTable
      resource_table_resourceName: "Title",
      resource_table_resourceUrlTitle: "Access Link",
      resource_table_resourceUrlDisplayName: "Link",
      resource_table_isProxy: "Proxy",
      resource_table_resourceType: "Type",
      resource_table_startDate: "Start Date",
      resource_table_expireDate: "End Date",
      resource_table_faculty: "School",
      resource_table_department: "Department",
      resource_table_subject: "Subject",
      resource_table_category: "Category",
      resource_table_type: "Type",
      resource_table_publisher: "Publisher",
      resource_table_language: "Language",
      resource_table_resourceDescribe: "Description",
      resource_table_relevanceUrlDescribe: "Information Link",
      resource_table_moreDetail: "more...",
      // tag
      tag_chinese: 'Chinese',
      tag_english: 'English',
      tag_japanese: 'Japanese'
    }
  },
  local: {
    message: {
      chooseLanguage:'言語を選択してください',
      header_logout: 'サインアウト',
      header_expiryResourceSetting: 'リソースの期限設定',
      // index page
      h1_resource_list: '電子データベースリスト',
      index_total: 'すべて',
      index_show_all: 'すべて',
      index_atoz: 'A to Z',
      index_zhuyin: '注音',
      index_strokes: '筆劃',
      index_kana: 'カナ',
      index_sort: 'ソート',
      index_bulletin: '看板',
      index_more: 'もっと見る',
      index_placeholder_text: 'リソースを検索',
      index_popular_frameTitle: '人気のリソース',
      index_popular_title: '標題',
      index_popular_clickAmount: '次數',
      index_commonly_title: '人気のあるリソース',
      // All Latest News page
      h1_all_latestNews: '最新ニュース',
      // admin index page
      adminIndex_account: 'アカウント',
      adminIndex_password: 'パスワード',
      adminIndex_account_pwd_rror: 'アカウントのパスワードが正しくありません',
      adminIndex_verifyCode: '検証コード',
      // Resource Management page
      h1_resource_management: 'リソース管理',
      resource_resourceKana: '並び替え用のカナ',
      resource_resourceName: 'リソース名',
      resource_resourceType: 'リソースタイプ',
      resource_faculty: '学部',
      resource_department: '学科',
      resource_subject: 'サブジェクト',
      resource_category: '分類',
      resource_publisher: '出版社',
      resource_language: '言語',
      resource_resourceDescribe: 'リソースの説明',
      resource_relevanceUrlDescribe: '参考リンク名',
      resource_startDate: '開始日',
      resource_expireDate: '終了日',
      resource_isProxy: 'Proxy/Redirectorの適用',
      resource_resourceUrl: 'アクセスリンクURL',
      resource_relevanceUrl: 'その他のURL',
      resource_btn_modify: '修正',
      resource_btn_add: '追加',
      resource_expired_display: '終了日が過ぎたらこのリソースを表示する',
      resource_stop_checking_expiring: '終了日チェックを終了する',
      // setting page
      h1_settings: '設定',
      generalSetting: '一般設定',
      tools: 'ツールキット',
      build_alphabet_stokes: 'AtoZインデックスをリビルドする',
      setting_ga: 'Google Analytics トラッキングID',
      setting_localization: '「言語選択」を表示する',
      setting_update_the_account_and_password: 'アカウントとパスワードを更新',
      setting_account_info: 'アカウント情報',
      setting_password_wronging: 'パスワードが間違っています',
      setting_password_not_matching: 'パスワードと確認用のパスワードが一致しません',
      setting_import_csv_data: 'リソースリスト（txtファイル）をインポートする',
      setting_proxy: 'Proxy/Redirector プレフィクスURL',
      setting_total_resources: 'リソース数合計',
      setting_show_popular_resources: '表示する「人気のリソース」の数（0の場合、フロントページに表示しません）',
      setting_show_database_number: '表示するリソースの数',
      setting_exportDatabaseFile: 'データベースリストのエクスポート',
      setting_exportContentIncludeHtml: 'HTMLを含むコンテンツのエクスポート',
      // latest news management page
      h1_latestNews: 'ニュース管理',
      latest_form_setting: 'ニュースブロック設定',
      latest_form_name: 'ブロックタイトル',
      latest_form_number_of_showing: '１ブロックに表示させるニュースの数',
      latest_publish_date: '発行日',
      latest_publish_title: 'タイトル',
      latest_publish_content: 'コンテンツ',
      latest_hot_news: 'ホットニュース',
      latest_hot_news_show_or_not_show: '表示',
      latest_hot_news_message: 'メッセージを選択',
      latest_hot_news_message_select: '選択',
      // expiry checking page
      h1_expiring: 'リソースの無効化管理',
      expiring_turn_on_the_feature: '機能を有効化する',
      expiring_days_before_expiry: '無効化までの日数',
      expiring_resource_status: 'リソースの状態',
      expiring_no_resource: 'リソースがありません',
      // Subject management page
      h1_subject: 'ファセット管理',
      subject_setting: 'ファセット管理',
      subject_title: 'ファセットタイトル',
      subject_name: '項目',
      subject_create_subject: '新規項目',
      subject_create_subject_item: '新規ファセットブロックを追加',
      subject_facet_field: 'ファセットフィールド',
      // identity management page
      h1_identity: 'アイデンティティ管理',
      identity_validateIdentity: 'アイデンティティの確認',
      identity_addNewItem: '新規項目を追加',
      identity_title_department: '部門',
      identity_title_Identity: 'アイデンティティ',
      select_options: 'オプション',
      select_sameLevel: '同じ階層に項目を追加',
      select_nextLevel: '次の階層に項目を追加',
      // Clicking Report page
      h1_clickingReport: 'レポート作成',
      clickingReport_start_date: '開始日',
      clickingReport_end_date: '終了日',
      clickingReport_display_by: 'レポート単位',
      clickingReport_day: '日',
      clickingReport_month: '月',
      clickingReport_departmemnt: '部門',
      clickingReport_userIdentity: 'ユーザーアイデンティティ',
      clickingReport_download_the_report: 'ダウンロード',
      // commonly resource
      h1_commonlyResource: '人気のリソース',
      commonlyResource_showOnFrontStage: '前に表示',
      commonlyResource_noResource: '人気のリソースはありません',
      commonlyResource_resourceList: '全てのリソース',
      commonlyResource_commonResourceList: '人気のリソース',
      // dialogue
      dialogue_title: 'タイトル',
      dialogue_title_warning: '警告',
      dialogue_title_info: '情報',
      dialogue_title_actpwd: 'アカウント・パスワード設定',
      dialogue_title_account: 'アカウント',
      dialogue_title_old_password: '古いパスワード',
      dialogue_title_new_password: '新しいパスワード',
      dialogue_title_confirm_new_password: '新しいパスワードを確認',
      dialogue_content_expired: 'アカウントが失効しています。もう一度ログインしてください。',
      dialogue_content_addSuccess: '追加しました。',
      dialogue_content_updateSuccess: '更新しました。',
      dialogue_content_deleteSuccess: '削除しました。',
      dialogue_content_account_updateSuccess: 'アカウントは正常にアップデートされました。もう一度ログインしてください。',
      dialogue_content_logout: 'ログアウトに成功しました',
      dialogue_content_import_successful: 'インポートが成功しました',
      dialogue_content_databaseUpload: 'データベースリストは上書きされます。アップロードしますか？',
      dialogue_content_deleteNews: 'このニュースを削除しますか？',
      // placeholder
      placeholder_searchResource: 'リソースを検索',
      // button
      btn_add: '追加',
      btn_copy: 'コピー',
      btn_recover: '復元',
      btn_update: '更新',
      btn_execute: '実行',
      btn_confirm: '確定',
      btn_cancel: '取消',
      btn_search: '検索',
      btn_close: 'クローズ',
      btn_modify: '変更',
      btn_download_report: 'レポートダウンロード',
      btn_sort_1: 'リソース名',
      btn_sort_2: '言語',
      btn_sort_3: '出版社',
      btn_sort_4: '分類',
      btn_sort_5: 'カナ',
      btn_login: 'ログイン',
      btn_change: ' 変更',
      // selector
      selector_yes: 'はい',
      selector_no: 'いいえ',
      // resourceTable
      resource_table_resourceName: "リソース名",
      resource_table_resourceUrlTitle: "リンク",
      resource_table_resourceUrlDisplayName: "Click リンク",
      resource_table_isProxy: "プロキシ",
      resource_table_resourceType: "リソースタイプ",
      resource_table_startDate: "開始日",
      resource_table_expireDate: "期限日",
      resource_table_faculty: "該当する学部",
      resource_table_department: "該当する学科",
      resource_table_subject: "サブジェクト",
      resource_table_category: "分類",
      resource_table_type: "種類",
      resource_table_publisher: "出版社",
      resource_table_language: "言語",
      resource_table_resourceDescribe: "リソースの説明",
      resource_table_relevanceUrlDescribe: "その他のリンク",
      resource_table_moreDetail: "詳細を見る",
      // tag
      tag_chinese: '中国語',
      tag_english: '英語',
      tag_japanese: '日本語'
    }
  }
}

var lang = '';
function initLanguage () {
  if("lang" in localStorage) {
    lang = localStorage.getItem('lang');
  } else {
    lang = navigator.language || navigator.userLanguage;
    if (lang === 'en-US') {
      lang = 'en';
    } else {
      lang = 'local';
    }
    localStorage.setItem('lang', lang);
  }
}
initLanguage();

var i18n = new VueI18n({
  locale: lang, // set locale
  messages, // set locale messages
})


// Statement heading of Resource List
let listTitles = [];
listTitles['en'] = {
  "resourceName": messages.en.message.resource_table_resourceName,
  "resourceUrlTitle": messages.en.message.resource_table_resourceUrlTitle,
  "resourceUrlDisplayName": messages.en.message.resource_table_resourceUrlDisplayName,
  "isProxy": messages.en.message.resource_table_isProxy,
  "resourceType": messages.en.message.resource_table_resourceType,
  "startDate": messages.en.message.resource_table_startDate,
  "expireDate": messages.en.message.resource_table_expireDate,
  "faculty": messages.en.message.resource_table_faculty,
  "department": messages.en.message.resource_table_department,
  "subject": messages.en.message.resource_table_subject,
  "category": messages.en.message.resource_table_category,
  "type": messages.en.message.resource_table_type,
  "publisher": messages.en.message.resource_table_publisher,
  "language": messages.en.message.resource_table_language,
  "resourceDescribe": messages.en.message.resource_table_resourceDescribe,
  "relevanceUrlDescribe": messages.en.message.resource_table_relevanceUrlDescribe,
  "moreDetail": messages.en.message.resource_table_moreDetail
}
listTitles['local'] = {
  "resourceName": messages.local.message.resource_table_resourceName,
  "resourceUrlTitle": messages.local.message.resource_table_resourceUrlTitle,
  "resourceUrlDisplayName": messages.local.message.resource_table_resourceUrlDisplayName,
  "isProxy": messages.local.message.resource_table_isProxy,
  "resourceType": messages.local.message.resource_table_resourceType,
  "startDate": messages.local.message.resource_table_startDate,
  "expireDate": messages.local.message.resource_table_expireDate,
  "faculty": messages.local.message.resource_table_faculty,
  "department": messages.local.message.resource_table_department,
  "subject": messages.local.message.resource_table_subject,
  "category": messages.local.message.resource_table_category,
  "type": messages.local.message.resource_table_type,
  "publisher": messages.local.message.resource_table_publisher,
  "language": messages.local.message.resource_table_language,
  "resourceDescribe": messages.local.message.resource_table_resourceDescribe,
  "relevanceUrlDescribe": messages.local.message.resource_table_relevanceUrlDescribe,
  "moreDetail": messages.local.message.resource_table_moreDetail
}
