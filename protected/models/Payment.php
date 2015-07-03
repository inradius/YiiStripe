<?php

/**
 * This is the model class for table "payment".
 *
 * The followings are the available columns in table 'payment':
 * @property integer $id
 * @property string $payment_id
 * @property string $payment_card
 * @property string $payment_token
 * @property string $payment_amount
 * @property string $payment_created
 * @property string $payment_fullname
 * @property string $payment_email
 * @property string $payment_description
 */
class Payment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('payment_fullname, payment_email', 'required', 'on' => 'payment'),
			array('payment_id, payment_card, payment_token, payment_amount, payment_created, payment_email', 'length', 'max'=>255),
			array('payment_fullname', 'length', 'max'=>45),
			array('payment_id, payment_card, payment_token, payment_amount, payment_created, payment_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, payment_id, payment_card, payment_token, payment_amount, payment_created, payment_fullname, payment_email, payment_description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'payment_id' => 'Payment',
			'payment_card' => 'Payment Card',
			'payment_token' => 'Payment Token',
			'payment_amount' => 'Payment Amount',
			'payment_created' => 'Payment Created',
			'payment_fullname' => 'Name on Card',
			'payment_email' => 'Payment Email',
			'payment_description' => 'Payment Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = new CDbCriteria;

        $criteria->compare('payment_email', $this->payment_email, true);

        return $criteria;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Payment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
