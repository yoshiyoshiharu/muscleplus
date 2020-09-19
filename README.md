# muscleplus
<img width="1114" alt="muscleplus" src="https://user-images.githubusercontent.com/54305137/93659246-2746dc00-fa7e-11ea-96c8-2b4dba2e0c83.png">

# 概要
「Muscle + 」

筋トレを長く続けられるように、楽しく筋トレの記録をするサービスです。
# URL
https://muscle-plus.com

右上のメニューバーからログインおよび新規登録が行えます。
また、【かんたんログイン】ボタンからゲストユーザーとして、ログインすることができます。
# 制作の背景
これまで、体を鍛えようと、自宅で筋トレを始めたり、ジムに通い始めたりしましたが、筋トレはすぐには効果がでず、モチベーションを保つのが難しくすぐに筋トレをやめてしまいました。

そこで、筋トレの鍛えた部位を記録し、タイムラインで公開することで、モチベーションを保てるようなサービスを開発しました。

また、筋トレはどうしても自分の好きな部位ばかりを鍛えがちですので、鍛えた部位を集計し、グラフにすることで鍛えた部位の割合を可視化し、バランスの良い筋トレを行えるようにしました。

# 機能一覧
- ユーザー登録・ログイン機能
- Facebookログイン機能
- 筋トレ記録機能
- いいね機能
- コメント機能

# 使用技術
## フロントエンド
- Bootstrap 4.2.1
- CSS
- JavaScript
- jQuery , Ajax
## バックエンド
- PHP 7.1.3
- Larvel 5.8
## DB設計
## 開発環境
- Docker/Docker-compose(Laradock)
- MySQL
- Nginx
## 本番環境
- AWS(VPC , EC2 , RDS , ALB , Route53 , Certificate Manager)
- MySQL
- Nginx
## インフラ構成図
![muscleplus](https://user-images.githubusercontent.com/54305137/93660997-4c901600-fa8f-11ea-8104-2bb7f1a915ab.jpg)
## その他
- 外部API(Facebook API)
- Githubの活用(イシュー、プルリク、マージなど)
