aws ecr get-login-password | docker login --username AWS --password-stdin 662301047086.dkr.ecr.us-east-1.amazonaws.com/emoji-search
docker build -t emoji-search:latest -f docker/apache/Dockerfile .
docker tag emoji-search:latest 662301047086.dkr.ecr.us-east-1.amazonaws.com/emoji-search
docker push 662301047086.dkr.ecr.us-east-1.amazonaws.com/emoji-search