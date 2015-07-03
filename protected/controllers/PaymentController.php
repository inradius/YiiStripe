<?php

class PaymentController extends Controller
{
    public function accessRules()
    {
        return array(
            // Actions: index, create, update, password, newPassword, forgotPassword, delete
            array('allow',
                'actions' => array('list', 'stripePayment', 'success'),
                'expression' => 'app()->user->isGuest()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionList()
    {
        $criteria = new CDbCriteria();

        $model = new Payment('search');

        if(isset($_GET['Payment']))
        {
            $model->attributes = $_GET['Payment'];
            $criteria->mergeWith($model->search());
        }

        $dataProvider = new CActiveDataProvider('Payment', array(
            'criteria' => $criteria
        ));

        $this->render('index', array(
            'model' => $model,
            'dataProvider' => $dataProvider
        ));
    }

    public function actionStripePayment()
    {
        $stripe = app()->stripe;
        $model = new Payment('payment');

        if(isset($_POST)) {
            $errors = array();
            if(isset($_POST['stripeToken'])) {
                $token = $_POST['stripeToken'];
                $model->attributes = $_POST['Payment'];
                if($model->validate()) {
                    try {
                        $payment = Stripe_Charge::create(array(
                            'amount' => 3500,
                            'currency' => 'usd',
                            'card' => $token
                        ));
                        if ($payment->paid == true) {
                            $model->payment_id = $payment->id;
                            $model->payment_card = $payment->card->id;
                            $model->payment_token = $token;
                            $model->payment_amount = $payment->amount;
                            $model->payment_created = $payment->created;
                            if ($model->save()) {
                                $this->redirect(array('success'));
                            }
                        }
                    } catch (Stripe_CardError $e) {
                        $body = $e->getJsonBody();
                        Shared::debug($body);
                    }
                }
            } else {
                $token = NULL;
                $errors['token'] = 'The payment could not be processed. Make sure you have JavaScript enabled.';
            }
        }

        $this->render('stripe', array(
            'model' => $model,
            'stripe' => $stripe,
            'token' => $token,
        ));
    }

    public function actionSuccess($token = null)
    {
        if(!is_null($token)) {
            $this->render('success');
        }
        $this->redirect(array('site/index'));
    }
}