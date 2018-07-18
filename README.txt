# 動けばとりあえず良いという考えで作成しています。セキュリティ面は考慮していません。
# ElasticSearcPHPを事前にインストールする必要があります。
# また、インストールして得られるvendorディレクトリをindex.htmlと同階層に設置する必要があります。
# nbator.phpの$hosts値を各自のElasticSearchのIPアドレスに修正する必要があります。
# 
# ElasticSearcのデータは、Kibanaを使用して、次のように登録しています。
# POST /nbator/doc/_bulk
# {"index": {"_id": 1}}
# {"name": "xxxxx", "american": "yes", "thirty_years_over": "yes", "active_player": "no", "height_over_2meters": "no", "champion": "yes", "god": "no", "uniform_color": "黄　黄　黄　黄　黄　黄", "good_play": "1 2 2 2 3 10", "position": "SG SF", "shirt_number": "1 2", "play_style": "1 1 1 1 1 4 4 4 4 4"}
#
# クエリは全てmatchクエリを使用して、テキスト検索させています。
# ElasticSearcのmatchクエリでは、同データ内に同じデータが入っていると、スコアが高くなる性質があり
# それを利用してスコア調整をして、登録しています。
