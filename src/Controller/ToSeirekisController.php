<?php
namespace App\Controller;

use Cake\Core\Configure;
use App\Controller\AppController;
use App\Form\ToSeirekiForm;

/**
 * ToSeireki Controller
 *
 */
class ToSeirekisController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //pr($this->request->query);
        $gengou_radio_options = Configure::read('gengou_yomi_kanji');
        $gengou_start_years = Configure::read('gengou_start_years');

        // query引数取得
        $wareki_gengou_yomi = '';
        $wareki_year=0;
        if(isset($this->request->query['gengou'])){
            $wareki_gengou_yomi=$this->request->query['gengou'];
        }
        if(isset($this->request->query['year'])){
            $wareki_year = $this->request->query['year'];
        }

        // Formを呼び出す
        $formEntity = new ToSeirekiForm();
        // 値設定
        $formEntity->setData(['gengou' => $wareki_gengou_yomi, 'year' => $wareki_year]);

        $seireki_year=0;
        // バリデーション呼び出し
        if ($formEntity->execute($this->request->query())) {
            // 正常時
            $wareki_gengou = $gengou_radio_options[$wareki_gengou_yomi];

            if ( isset($gengou_start_years[$wareki_gengou_yomi])){
                $seireki_year = $gengou_start_years[$wareki_gengou_yomi] + $wareki_year - 1;
            } else {
                // 設定ファイルにエラーがある。指定の元号の開始西暦情報がありません。
                $this->Flash->error('Webサーバー上の設定ファイルにエラーがあります。指定の元号ローマ字読み「'.$wareki_gengou_yomi.'」に関連する情報が登録ありません。');
            }

        } else {
            // エラー時
            $this->Flash->error('入力項目にエラーがあります。');
        }
        $this->set('formEntity', $formEntity );

        $this->set(compact('formEntity','gengou_radio_options','wareki_gengou', 'wareki_year', 'seireki_year'));


        // ホープ―ページのデザイン流用
        $this->render('/pages/home');

    }

}
