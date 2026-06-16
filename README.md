# NitkitShare
Sharing Site Development

Git運用ルール

## ブランチ

```
main
└── develop
    ├── feature/auth (ログイン画面担当)
    ├── feature/thread (掲示板機能担当)
    ├── feature/post (投稿機能担当)
    └── feature/dm (フレンド機能担当)
```
### 開発手順
developからブランチ作成
```
git checkout develop
```
```
git checkout -b feature/xxx
```

作業

### commit
```
git commit -m "feat: thread create api"
```
### Push
```
git push origin feature/xxx
```
Pull Requestを作成

レビュー後 develop にマージ

### コミットメッセージ

例)

feat: 新機能追加

fix: バグ修正

docs: ドキュメント更新

refactor: リファクタリング

style: コード整形
