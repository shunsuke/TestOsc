# TestOsc
本リポジトリは、Open Sound Control (OSC) プロトコルを用いた通信を検証するためだけの簡易な環境を提供します。  
OSCサーバーと、PythonおよびPHPで実装されたOSCクライアントが含まれています。  
この環境を利用することで、OSC通信の基本的な動作確認や、自作アプリケーションへの組み込み前のテストに役立てることができます。

## 環境構築
前提条件: DockerとDocker Composeがインストールされていること。  
クローン: git clone https://github.com/shunsuke/TestOsc.git

## コンテナの構築と、コンテナ・サーバーの起動
docker compose up -d
バックグラウンドでサーバーが起動します。

## クライアントを実行してメッセージを送信
### Pythonクライアント
コンテナ外から次の内容を実行するか、  
docker-compose exec osc_client_python python osc_client.py  
次のコマンドでコンテナに入り、  
docker compose exec osc_client_python /bin/bash  
コンテナ内で python osc_client.py を実行する。

### PHPクライアント
コンテナ外から次の内容を実行するか、  
docker-compose exec osc_client_php php osc_client.php  
次のコマンドでコンテナに入り、  
docker compose exec osc_client_php /bin/bash  
コンテナ内で php osc_client.php を実行する。

## OSCサーバーの起動時と受信時のログ確認
OSCサーバーの起動時と、メッセージの受信時に、osc_server/osc_server_log.txtに追記しており、  
送信されたメッセージの受信状況を確認できます。

