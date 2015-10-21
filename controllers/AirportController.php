<?php

namespace app\controllers;

use Yii;
use app\models\Airport;
use app\models\User;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AirportController implements the CRUD actions for Airport model.
 */
class AirportController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    // 'api_login' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Airport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Airport::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Airport model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Airport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Airport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->airport_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Airport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->airport_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Airport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Airport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Airport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Airport::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
 
    public function actionApi_login()
    {
        $params = Yii::$app->request->post();
        $UserDetails=(User::findIdentity($params['id']));
        $response=array('status'=>0,'data'=>array());
        if($UserDetails != null ){
            $response['status']=1;
            $response['data']['id']=$UserDetails->id;
            $response['data']['accessToken']=$UserDetails->accessToken;
            $response['data']['type']=User::getUserType($UserDetails->id);
        }
        echo json_encode($response);
    }

    public function actionApi_getairport(){
     $params = Yii::$app->request->post();
     $response=array(
        'status'=>1,
        'airports'=>''
        );
     if(isset($params['airport_code'])){
            $airport_code=($params['airport_code']);
            $response['airports'] = Airport::find()->where(['airport_code'=>$airport_code])->asArray()->all(); 
        }else{
           $response['airports']= Airport::find()->asArray()->all();
        }
       $format= $params['format'];
        if($format=='json'){

            header('Content-Type: application/json');

            echo json_encode($response);
        }else{
            header('Content-Type: text/xml');
            echo '<?xml version="1.0"?>';
            echo "<status>".$response['status']."</status>";
            echo "<airports>";
            foreach($response['airports'] as $key => $value){
                echo "<airport>";
                foreach($value as $dataHeader => $dataValue){
                    echo "<$dataHeader>$dataValue</$dataHeader>"; 
                }
                echo "</airport>";
            }
            echo "</airports>";

       }
   }

 

}
