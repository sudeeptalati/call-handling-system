<?php

/**
 * This is the model class for table "tasks_to_do".
 *
 * The followings are the available columns in table 'tasks_to_do':
 * @property integer $id
 * @property string $task
 * @property string $status
 * @property string $msgbody
 * @property string $subject
 * @property string $send_to
 * @property string $created
 * @property string $scheduled
 * @property string $executed
 * @property string $finished
 */
class TasksToDo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TasksToDo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tasks_to_do';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('task, status, msgbody, subject, send_to, created, scheduled, executed, finished', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, task, status, msgbody, subject, send_to, created, scheduled, executed, finished', 'safe', 'on'=>'search'),
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
			'task' => 'Task',
			'status' => 'Status',
			'msgbody' => 'Msgbody',
			'subject' => 'Subject',
			'send_to' => 'Send To',
			'created' => 'Created',
			'scheduled' => 'Scheduled',
			'executed' => 'Executed',
			'finished' => 'Finished',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('task',$this->task,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('msgbody',$this->msgbody,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('send_to',$this->send_to,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('scheduled',$this->scheduled,true);
		$criteria->compare('executed',$this->executed,true);
		$criteria->compare('finished',$this->finished,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}