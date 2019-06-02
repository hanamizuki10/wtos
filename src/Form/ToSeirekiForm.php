<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class ToSeirekiForm extends Form
{

	protected function _buildSchema(Schema $schema)
	{
		// フィールドの設定です。
        return $schema->addField('gengou', 'string');
        return $schema->addField('year', 'integer');

	}

	protected function _buildValidator(Validator $validator)
	{
		// 和暦
		$validator
			->scalar('gengou')  // 文字列系であること
            ->notEmpty('gengou', '入力してください');

        // 年数
        $validator
            ->integer('year', '数値で入力してください。')   // 数値であること
            ->notEmpty('year','入力してください。'); // 空文字ではない事



		return $validator;
	}

	protected function _execute(array $data)
	{
		// バリデーションが通った時に実行されます。
		// ここでは単にtrueを返すだけです。
		return true;
	}

    public function setQueryData(array $query){
        $wareki = '';
        if(isset($query['gengou'])){
            $wareki=$query['gengou'];
        }
        if(isset($query['year'])){
            $year = $query['year'];
        }
        $this->setData(['gengou' => $wareki, 'year' => $year]);
    }
}
