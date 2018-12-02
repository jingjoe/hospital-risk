<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
          if (!Yii::$app->user->isGuest) {
              
                $ir= Yii::$app->user->identity->id;
                
                $cid_d= Yii::$app->user->identity->cid;
                
                $sql_dep = Yii::$app->db->createCommand("SELECT department_id FROM member  WHERE cid='$cid_d'")->queryOne();
                $dep_id =  $sql_dep['department_id'];
                
                $sql_te = Yii::$app->db->createCommand("SELECT IFNULL(team_id,0) AS team_id FROM member  WHERE cid='$cid_d'")->queryOne();
                $te_id =  $sql_te['team_id'];
        
                $use = "SELECT COUNT(id) AS cc,status_risk FROM riskregister WHERE sendto_member_cid=$cid_d AND  status_risk ='ตรวจสอบ' ";
                $dep = "SELECT COUNT(id) AS cc,status_risk FROM riskregister WHERE sendto_department_id=$dep_id AND  status_risk ='ตรวจสอบ' ";
                $team = "SELECT COUNT(id) AS cc,status_risk FROM riskregister WHERE sendto_team_id=$te_id AND  status_risk ='ตรวจสอบ' ";
                $all = "SELECT COUNT(id) AS cc FROM riskregister WHERE created_by=$ir ";
                $status = "SELECT 'สถานะรายงาน' AS st,COUNT(id) AS c
                           FROM riskregister
                           WHERE created_by=$ir AND status_risk='รายงาน'

                           UNION
                           SELECT 'สถานะตรวจสอบ' AS st,COUNT(id) AS c
                           FROM riskregister
                           WHERE created_by=$ir AND status_risk='ตรวจสอบ'

                           UNION
                           SELECT 'สถานะทบทวน' AS st,COUNT(id) AS c
                           FROM riskregister
                           WHERE created_by=$ir AND status_risk='ทบทวน'

                           UNION
                           SELECT 'สถานะจำหน่าย' AS st,COUNT(id) AS c
                           FROM riskregister
                           WHERE created_by=$ir AND status_risk='จำหน่าย'";
                
                $touse= Yii::$app->db->createCommand($use)->queryAll();
                $todep= Yii::$app->db->createCommand($dep)->queryAll();
                $toteam= Yii::$app->db->createCommand($team)->queryAll();
                $toall= Yii::$app->db->createCommand($all)->queryAll();
                
                $risk_st= Yii::$app->db->createCommand($status)->queryAll();
   
                return $this->render('index',[
                        'user_ir' => $ir,
                        'touse' => $touse,
                        'todep' => $todep,
                        'toteam' => $toteam,
                        'toall' => $toall,
                        'risk_st' => $risk_st,
                        ]);

          } else {
             return $this->render('index2');
          }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */

      public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            $username = $model->username;
            $ip = \Yii::$app->getRequest()->getUserIP();

            $sql = " INSERT INTO `user_log` (`username`,`login_date`, `ip`) VALUES ('$username',NOW(), '$ip') ";
            \Yii::$app->db->createCommand($sql)->execute();
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
