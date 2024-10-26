<?php
class M_Lang extends CI_Model
{

    public function default_lang()
    {
        // ======================================
        // Language default English
        // ======================================
        $data_lang = $this->m_lang->lang_en();
        $data = array(
            'language' => 'en',
            'data_lang' => $data_lang,
        );
        // ======================================
        
        // ======================================
        // Language default Japanese
        // ======================================
        // $data_lang = $this->m_lang->lang_jp();
        // $data = array(
        //     'language' => 'jp',
        //     'data_lang' => $data_lang,
        // );
        // ======================================
        $this->session->set_userdata($data);

        if ($this->session->userdata('language')) {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function lang_en()
    {
        $lang = array(
            "title" => " | Data Sales Rokesuma Web",
            "name_web" => "Data Sales Rokesuma Web",
            "name_ari" => "Asia Research Institute",
            //===== Start Navbar =====
            "home" => "Home",
            "about" => "About",
            "contact" => "Contact Us",
            "faq" => "Frequently Asked Questions (FAQ)",
            "prefecture_analysis" => "Chain Link",
            "city_analysis" => "City Analysis",
            "services" => "Services",
            "product" => "Product",
            "my_company" => "My Company",
            // "poi_data" => "POI data",
            // "our_data_product" => "Our data product",
            // "why_choose_us" => "Why choose us",
            "poi_data" => "Nationwide Chain Store Data",
            "our_data_product" => "Mall Tenant Data",
            "why_choose_us" => "Location Technology Features",
            "my_profile" => "Account",
            "my_account" => "Account Information",
            "sitemap" => "Sitemap",
            "history" => "Quotation history",
            "logout" => "Logout",
            "login" => "Login",
            "register" => "Register",
            "login_or_register" => "Login or Register",
            //===== End Navbar =====

            //===== Start Placeholder input =====
            "enter_email" => "Please enter email",
            "enter_password" => "Please enter password",
            "enter_first_name" => "Please enter first name",
            "enter_last_name" => "Please enter last name",
            "enter_username" => "Please enter username",
            //===== End Placeholder input =====

            //===== Start Login Page =====
            "welcome_back" => "Welcome Back!",
            "login_continue" => "Sign in to continue.",
            "email" => "Email",
            "password" => "Password",
            "forgot_password" => "Forgot Password",
            "btn_login" => "Log In",
            "create_account" => "Don't have an account ? ",
            "signup_now" => "Signup now",
            //===== End Login Page =====

            //===== Start Forgot Page =====
            "reset_password" => "Reset Password",
            "enter_your_email" => "Enter your Email and instructions will be sent to you!",
            "btn_reset" => "Reset",
            "remember" => "Remember It? ",
            "sign_in_here" => "Sign In here",
            //===== End Forgot Page =====
            
            //===== Start Register Page =====
            "free_register" => "Free Register",
            "message" => "Message",
            "full_name" => "Full Name",
            "first_name" => "First Name",
            "last_name" => "Last Name",
            "username" => "Username",
            "register" => "Register",
            "already_account" => "Already have an account ? ",
            //===== End Register Page =====

            "comming_soon" => "This feature will be coming soon",
            "stay_tuned" => "Stay tuned",
            
            //===== Start Prefecture Page =====
            "prefecture" => "Prefecture",
            "city" => "City",
            "large_industry" => "Large Industry",
            "industry" => "Industry",
            "chain" => "Chain",
            "placeholder_select" => "--- Select ---",
            "calendar" => "Calendar",
            "category" => "Category",
            "store" => "Store",
            "fee" => "Fee per store",
            "JPY" => "JPY",
            "streets" => "Streets",
            "volume_discount" => "Volume Discount",
            "cost_location" => "Cost per location",
            "data_fee" => "Data Fee",
            "data_extract" => "Data Extraction Fee",
            "admin_fee" => "Admin Fee",
            "quotation" => "Quotation",
            "yen" => "円",
            "jpy" => "JPY",
            "satellite" => "Satellite",
            "light" => "Light",
            "dark" => "Dark",
            "payment" => "Payment",
            "confirm_payment" => "Confirmation of quotation",
            "latest_data" => "Latest Data",
            "estimation_price" => "Estimation Price",
            "request_quotation" => "Request Quotation",
            "complete_captcha" => "Please complete the captcha to request a quote",
            //===== End Prefecture Page =====

            //===== Start City Analisis =====
            "element_intro_pref_1" => "<li>This page focus on what specific <b>prefecture</b> chain data that you want to buy.</li>
                                    <li>You can select <b>prefecture</b>, <b>chain</b>, and <b>category</b> in dropdown below.</li>
                                    <li>Estimated price will be shown in map below.</li>
                                    <li>Minimum transaction you buy is <b>25,000 JPY</b>.</li>",
            "element_intro_pref_2" => '<li>You can download see sample data by clicking <a href="javascript:void(0);">here</a>.</li>',

            "element_intro_city_1" => "<li>This page focus on what specific <b>city</b> chain data that you want to buy.</li>
                                <li>You can select <b>prefecture</b>, <b>city</b>, <b>chain</b>, and <b>category</b> in dropdown below.</li>
                                <li>Estimated price will be shown in map below.</li>
                                <li>Minimum transaction you buy is <b>25,000 JPY</b>.</li>",
            "element_intro_city_2" => '<li>You can download see sample data by clicking <a href="javascript:void(0);">here</a>.</li>
                                <li>To search specific <b>prefecture</b> chain data you can go <a href="'.base_url("prefecture"). '">here</a>.</li>
                                <li>To search specific <b>chain</b> first you can go <a href="javascript:void(0);">here</a>. <i>*Include all city and prefecture.</i></li>
                                <li>For every <b>20,000 JPY</b> you spend you got 1% <b>discount</b>. <i>*Maximum 10% discount.</i></li>
                                <li><b>Discount</b> will be applied automaticly after <b>calendar</b> selected.</li>',
            //===== End City Analisis =====

            //===== Start Confirm Quotation Page =====
            "quotation_pref" => "Confirmation of quotation from Chain Link",
            "quotation_city" => "Confirmation of quotation from City Analysis",
            "estimated_result" => "Estimated result",
            "sub_title_estimated" => 'Please check the following and apply for a quote by clicking "Form request data information"',
            "form_request_data" => "Form request data information",
            "sub_title_request" => "Please fill in the required items in the fileds below to apply for a formal quote.",
            "save_success" => "Saved successfully",
            "are_you_sure" => "Are you sure?",
            "ok" => "OK",
            "cancel" => "Cancel",
            "close" => "Close",
            "estimated_datetime" => "Estimated date and time",
            "year" => "Year",
            "point_price" => "Point unit price",
            "total_point" => "Total number of point",
            // "total_store" => "Total number of store",
            "price" => "Price",
            "tax_10%" => "Tax (10%)",
            "tax_20%" => "Tax (20%)",
            "estimated_amount" => "Estimated Amount",
            "total" => "Total",
            "company" => "Company",
            "name_person" => "Name of person in charge",
            "email_quote" => "E-mail address to send a quote",
            "phone_number" => "Phone Number",
            "name_cardholder" => "Name cardholder",
            "card_number" => "Card Number",
            "exp_mm_yy" => "Expiration (mm/yy)",
            "cvv" => "CVV",
            "pay_by_credit" => "Pay by Credit Card",
            "list_app_chain" => "Selected store list.",
            "chain_name" => "Chain Name",
            "chain_id" => "Chain Id",
            "id" => "ID",
            "no" => "No",
            "for_detail_see" => 'For details see "List of application chains" below',
            "comp_cap" => "Complete captcha",
            //===== End Confirm Quotation Page =====

            //===== Start Product Page =====
            "product_detail" => "Product Detail",
            "category_product" => "Category Product",
            "search" => "Search",
            "filter" => "Filter",
            "reset_filter" => "Reset Filter",
            "description" => "Description",
            "add_to_cart" => "Add to cart",
            "buy_now" => "Buy now",
            "view_sample_data" => "View Sample Data",
            "load_more" => "Load more",
            "load_less" => "Load less",
            "start_tour" => "Start Tour",
            "back" => "Back",
            //===== End Product Page =====

            //===== Start My Account =====
            "edit" => "Edit",
            "edit_personal" => "Edit Personal Information",
            "hitory_list" => "Three Recent History Lists",
            "personal_info" => "Personal Information",
            "v_all_history" => "View all history",
            "email_address" => "Email address",
            "address" => "Address",
            "phone_number" => "Phone Number",
            "change_password" => "Change Password",
            "profile_picture" => "Profile picture",
            "save_change" => "Save Changes",            
            "old_password" => "Old Password",
            "new_password" => "New Password ",
            "confirm_password" => "Confirm Password ",
            //===== End My Account =====

            //===== Start History =====
            "history_list" => "History List",
            "order_id" => "Order ID",
            // "order_date" => "Order Date",
            "order_date" => "Quotation Date",
            "total_chain" => "Total chain",
            "total_store" => "Total store",
            "payment_status" => "Payment Status",
            "invoice" => "Invoice",
            "download" => "Download",
            "paid" => "Paid",
            "already_paid" => "Already paid",
            "on_process" => "On Process",
            "waiting_pay" => "Waiting for payment",
            "pending" => "Pending",
            "fail" => "Fail",
            "done" => "Done",
            //===== End History =====

            //===== Start History Card =====
            "pref_or_city" => "Prefecture / City",
            "ecommerce" => "Ecommerce",
            "total_price" => "Total Price",
            "detail" => "Detail",
            "status" => "Status",
            "pay" => "Pay",
            "all" => "All",
            "success" => "Success",
            "expired" => "Expired",
            "wait_for_pay" => "Waiting For Payment",
            "search_holder" => "Search...",
            "display" => "Display",
            "items_per_page" => "items per page.",
            "page" => "Page",
            "of" => "of",
            "to" => "to",
            "showing" => "Showing",
            "detail_trans" => "Detail Transaction",
            "thank_review" => "Thank you for reviews",
            "review" => "Reviews",
            "download_file" => "Download File",
            "download_list" => "Download list",
            "file" => "File",
            "total_disc" => "Total Discount",
            "total_pay" => "Total Payment",
            "payment_detail" => "Payment Details",
            // "no_invoice" => "No Invoice",
            "no_invoice" => "RFQ Number",
            "purchase_date" => "Purchase date",
            "submit" => "Submit",
            "send" => "Send",
            "no_data_trans" => "No transaction data yet",
            "no_data_yet" => "No data yet",        
            "keyword_not_found" => "Keyword not found, please reset the search",
            "here" => "here",
            "unknown" => "Unknown",
            "and_more" => "and more ...",
            "pref_custom_buy" => "Prefecture Custom Buy",
            "city_custom_buy" => "City Custom Buy",
            "complete_payment" => "Complete Payment",
            "contact_support" => "Contact Support",
            //===== End History Card =====

            //===== Start Cart =====
            "cart" => "Cart",
            "photo_product" => "Photo Product",
            "product_name" => "Product Name",
            "action" => "Action",
            "order_summary" => "Order Summary",
            "grand_total" => "Grand Total",
            "continue_shopping" => "Continue Shopping",
            "checkout" => "Checkout",
            "tax" => "Tax",
            //===== End Cart =====
            
            //===== Start Invoice =====
            "number_category" => "Number of categories",
            "number_chain" => "Number of chains",
            "number_store" => "Number of stores",
            "bill_to" => "Bill to",
            "print" => "Print",
            "download_invoice" => "Download invoice",
            "ari_inc" => "Asia Research Institute Inc.",
            "address_ari_jp" => "Neoba Bldg 2-2-5, Tomigaya, Shibuya-ku, Tokyo, Japan, 151-0063",
            "not_found_invoice" => "Sorry, no data was found for this invoice",
            "discount" => "Discount",
            "subtotal_disc" => "Subtotal discount",            
            "subtotal_price" => "Subtotal price",
            "subtotal_after_disc" => "Subtotal price after discount",
            //===== End Invoice =====
            
        );
        return $lang;
    }

    public function lang_jp()
    {
        $lang = array(
            "title" => " | データ販売ロケスマWeb",
            "name_web" => "データ販売ロケスマWeb",
            "name_ari" => "アジア総合研究所",
            //===== Start Navbar =====
            "home" => "ホーム",
            "about" => "約",
            "contact" => "お問い合わせ",
            "faq" => "よくある質問 (FAQ)",
            "prefecture_analysis" => "チェーンリンク",
            "city_analysis" => "都市分析",
            // "services" => "サービス",
            "services" => "プロダクト",
            "product" => "製品",
            // "my_company" => "弊社",
            "my_company" => "弊社について",
            // "poi_data" => "POI データ",
            // "our_data_product" => "当社のデータ製品",
            // "why_choose_us" => "なぜ私たちを選ぶのか",
            "poi_data" => "全国チェーン店データ",
            "our_data_product" => "モールテナントデータ",
            "why_choose_us" => "ロケーションテクノロジーの機能",
            "my_profile" => "アカウント",
            "my_account" => "アカウント情報",
            "sitemap" => "サイトマップ",
            // "history" => "歴史",
            "history" => "見積履歴",
            "logout" => "ログアウト",
            "login" => "ログイン",
            "register" => "新規登録",
            "login_or_register" => "ログインまたは登録",            
            //===== End Navbar =====

            //===== Start Placeholder input =====
            "enter_email" => "メールアドレスを入力してください",
            "enter_password" => "パスワードを入力してください",
            "enter_first_name" => "名を入力してください",
            "enter_last_name" => "姓を入力してください",
            "enter_username" => "ユーザー名を入力してください",
            //===== End Placeholder input =====

            //===== Start Login Page =====
            "welcome_back" => "おかえりなさい!",
            "login_continue" => "続行するにはサインインしてください。",
            "email" => "メール",
            "password" => "パスワード",
            "forgot_password" => "パスワードを忘れた",
            "btn_login" => "ログイン",
            "create_account" => "アカウントを持っていませんか? ",
            "signup_now" => "今すぐサインアップ",
            //===== End Login Page =====

            //===== Start Forgot Page =====
            "reset_password" => "パスワードのリセット",
            "enter_your_email" => "メールアドレスを入力してください。指示が送信されます!",
            "btn_reset" => "リセット",
            "remember" => "覚えていますか? ",
            "sign_in_here" => "サインインはこちら",
            //===== End Forgot Page =====

            //===== Start Register Page =====
            "free_register" => "無料登録",
            "message" => "メッセージ",
            "full_name" => "フルネーム",
            "first_name" => "名",
            "last_name" => "姓",
            "username" => "ユーザー名",
            "register" => "登録",
            "already_account" => "すでにアカウントをお持ちですか? ",
            //===== End Register Page =====

            "comming_soon" => "この機能は近日公開予定です",
            "stay_tuned" => "お楽しみに",

            //===== Start Prefecture Page =====
            "prefecture" => "都道府県",
            "city" => "都市",
            // "large_industry" => "大規模な産業",
            // "industry" => "産業",
            "large_industry" => "カテゴリー大",
            "industry" => "カテゴリー中",
            "chain" => "チェーン",
            "placeholder_select" => "--- 選択する ---",
            "calendar" => "カレンダー",
            "category" => "カテゴリ",
            "store" => "店舗",
            "fee" => "店舗ごとの手数料",
            "JPY" => "JPY",
            "streets" => "通り",
            "satellite" => "衛生",
            "light" => "光",
            "dark" => "暗い",
            "payment" => "支払い",
            "confirm_payment" => "見積もりの確認",
            "latest_data" => "最新データ",
            "estimation_price" => "見積もり価格",
            "request_quotation" => "見積依頼",
            //===== End Prefecture Page =====

            //===== Start City Analisis =====
            "element_intro_pref_1" => "<li>このページでは、購入したい特定の<b>都道府県</b>のチェーン データに焦点を当てています。</li>
                                <li>下のドロップダウンで<b>都道府県</b>、<b>チェーン</b>、<b>カテゴリ</b>を選択できます。</li>
                                <li>推定価格は下の地図に表示されます。</li>
                                <li>最低購入額は <b>25,000 円</b>です。</li>",
            "element_intro_pref_2" => '<li><a href="javascript:void(0);">こちら</a>をクリックすると、サンプル データをダウンロードできます。</li>',
                                
            "element_intro_city_1" => "<li>このページでは、購入したい特定の <b>都市</b> チェーン データに焦点を当てています。</li>
                                <li>下のドロップダウンで<b>都道府県</b>、<b>都市</b>、<b>チェーン</b>、および<b>カテゴリ</b>を選択できます。</li>
                                <li>推定価格は下の地図に表示されます。</li>
                                <li>最低購入額は <b>25,000 円</b>です。</li>",
            "element_intro_city_2" => '<li><a href="javascript:void(0);">こちら</a>をクリックすると、サンプル データをダウンロードできます。</li>
                                <li>特定の<b>都道府県</b>のチェーン データを検索するには、<a href="' . base_url("prefecture") . '">こちら</a>にアクセスしてください。</li>
                                <li>最初に特定の<b>チェーン</b>を検索するには、<a href="javascript:void(0);">こちら</a>にアクセスしてください。 <i>*すべての都市と都道府県を含めます。</i></li>
                                <li><b>20,000 円</b>お買い上げごとに 1% の<b>割引</b>が得られます。 <i>*最大 10% 割引。</i></li>
                                <li><b>カレンダー</b>を選択すると、<b>割引</b>が自動的に適用されます。</li>',
            //===== End City Analisis =====

            //===== Start Confirm Quotation Page =====
            "quotation_pref" => "からの引用の確認 Chain Link",
            "quotation_city" => "都市分析からの引用の確認",
            "estimated_result" => "推定結果",
            "sub_title_estimated" => '下記をご確認の上、「フォーム 資料請求フォーム」よりお見積りをお申し込みください。',
            "form_request_data" => "フォームリクエストデータ情報",
            "sub_title_request" => "以下の項目に必要事項をご記入の上、正式なお見積りをお申し込みください。",
            "save_success" => "正常に保存",
            // "ok" => "わかった",
            "are_you_sure" => "よろしいですか?",
            "ok" => "OK",
            "cancel" => "キャンセル",
            "close" => "閉じる",
            "estimated_datetime" => "推定日時",
            "year" => "年",
            "point_price" => "ポイント単価",
            "total_point" => "総ポイント数",
            // "total_store" => "総店舗数",
            "price" => "価格",
            "tax_10%" => "税金 (10%)",
            "tax_20%" => "税金 (20%)",
            "estimated_amount" => "推定金額",
            "total" => "合計",
            "company" => "会社",
            "name_person" => "担当者名",
            "email_quote" => "見積もりを送るメールアドレス",
            "phone_number" => "電話番号",
            "name_cardholder" => "名刺入れ",
            "card_number" => "カード番号",
            "exp_mm_yy" => "有効期限 (mm/yy)",
            "cvv" => "CVV",
            "pay_by_credit" => "クレジットカードで支払う",
            "cost_location" => "1地点あたりの単価",
            "data_fee" => "データ販売価格",
            "volume_discount" => "ボリュームディスカウント",
            "data_extract" => "データ抽出費用",
            "admin_fee" => "事務手数料",
            "quotation" => "お見積り額",
            "yen" => "円",
            "jpy" => "JPY",
            "list_app_chain" => "選択した店舗リスト",
            "chain_name" => "チェーン名",
            "chain_id" => "チェーン ID",
            "id" => "ID",
            "no" => "いいえ",
            "for_detail_see" => '詳細については、以下の「アプリケーション チェーンのリスト」を参照してください。',
            "complete_captcha" => "見積依頼するにはキャプチャを完了してください。",
            "comp_cap" => "キャプチャ",
            //===== End Confirm Quotation Page =====

            //===== Start Product Page =====
            "product_detail" => "製品の詳細",
            "category_product" => "カテゴリ 製品",
            "search" => "探す",
            "filter" => "フィルター",
            "reset_filter" => "フィルターをリセット",
            "description" => "説明",
            "add_to_cart" => "カートに追加",
            "buy_now" => "今買う",
            "view_sample_data" => "サンプルデータを見る",
            "load_more" => "もっと読み込む",
            "load_less" => "負荷を減らす",
            "start_tour" => "ツアーを開始",
            "back" => "戻る",
            //===== End Product Page =====

            //===== Start My Account =====
            "edit" => "編集",
            "edit_personal" => "個人情報の編集",
            "hitory_list" => "最近の 3 つの履歴リスト",
            "personal_info" => "個人情報",
            "v_all_history" => "すべての履歴を表示",
            "email_address" => "メールアドレス",
            "address" => "住所",
            "phone_number" => "電話番号",
            "change_password" => "パスワードの変更",
            "profile_picture" => "プロフィール写真",
            "save_change" => "変更を保存",
            "old_password" => "古いパスワード",
            "new_password" => "新しいパスワード",
            "confirm_password" => "パスワードの確認",
            //===== End My Account =====

            //===== Start History =====
            "history_list" => "履歴リスト",
            "order_id" => "注文ID",
            // "order_date" => "注文日",
            "order_date" => "見積依頼日",
            "total_chain" => "総チェーン",
            // "total_store" => "トータルストア",
            "total_store" => "店舗数合計",
            "payment_status" => "支払い状況",
            "invoice" => "請求書",
            "download" => "ダウンロード",
            "paid" => "支払った",
            "already_paid" => "支払い済み",
            "on_process" => "処理中",
            "waiting_pay" => "支払い待ち",
            "pending" => "保留中",
            "fail" => "失敗",
            "done" => "完了",
            //===== End History =====

            //===== Start History Card =====
            "pref_or_city" => "都道府県/市",
            "ecommerce" => "eコマース",
            "total_price" => "合計金額",
            "detail" => "詳細", 
            "status" => "ステータス",
            "pay" => "支払う",
            "all" => "全て",
            "success" => "成功",
            "expired" => "期限切れ",
            "wait_for_pay" => "支払い待ち",
            "search_holder" => "検索...",
            "display" => "表示",
            "items_per_page" => "ページあたりのアイテム数",
            "page" => "ページ",
            "of" => "の",
            "to" => "へ",
            "showing" => "表示中",
            "detail_trans" => "詳細取引",
            "thank_review" => "レビューありがとうございます",
            "review" => "レビュー",
            "download_file" => "ダウンロードファイル",
            "download_list" => "ダウンロードリスト",
            "file" => "ファイル",
            "total_disc" => "合計割引",
            "total_pay" => "お支払い総額",
            "payment_detail" => "支払詳細",
            // "no_invoice" => "請求書なし",
            "no_invoice" => "見積依頼番号",
            "purchase_date" => "購入日",
            "submit" => "参加する",
            "send" => "送信", 
            "no_data_trans" => "まだ取引データがありません",
            "no_data_yet" => "まだデータがありません",
            "keyword_not_found" => "キーワードが見つかりません。検索をリセットしてください",
            "here" => "こちら",
            "unknown" => "不明",
            "and_more" => "さらに...",
            "pref_custom_buy" => "都道府県カスタム購入",
            "city_custom_buy" => "都市カスタム購入",
            "complete_payment" => "支払い完了",
            "contact_support" => "サポートに連絡",
            //===== End History Card =====

            //===== Start Cart =====
            "cart" => "カート",
            "photo_product" => "写真製品",
            "product_name" => "商品名",
            "action" => "アクション",
            "order_summary" => "注文の概要",
            "grand_total" => "総計",
            "continue_shopping" => "ショッピングを続ける",
            "checkout" => "チェックアウト",
            "tax" => "税",
            //===== End Cart =====
            
            //===== Start Invoice =====
            "number_category" => "カテゴリ数",
            "number_chain" => "チェーンの数",
            "number_store" => "店舗数",
            "bill_to" => "請求書送付先",
            "print" => "印刷する",
            "download_invoice" => "請求書をダウンロード",
            "ari_inc" => "Asia Research Institute Inc.",
            "address_ari_jp" => "Neoba Bldg 2-2-5, Tomigaya, Shibuya-ku, Tokyo, Japan, 151-0063",
            "not_found_invoice" => "この請求書のデータは見つかりませんでした",
            "discount" => "割引",
            "subtotal_disc" => "小計割引",
            "subtotal_price" => "小計価格",
            "subtotal_after_disc" => "割引後の小計",
            //===== End Invoice =====

        );
        return $lang;
    }
}
