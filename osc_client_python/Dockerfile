# ベースイメージ
FROM python:3.9-slim-buster

# 作業ディレクトリの指定
WORKDIR /app

# パッケージのインストール
COPY requirements.txt requirements.txt
RUN pip install -r requirements.txt

# Pythonファイルのコピー
COPY . .

# dummyのコマンド　pythonではない。dummy
CMD ["tail", "-f", "/dev/null"]



