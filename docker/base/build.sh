aws ecr-public get-login-password --region us-east-1 | docker login --username AWS --password-stdin public.ecr.aws/b6l5k5p0
docker build -t base-image .
docker tag base-image:latest public.ecr.aws/b6l5k5p0/base-image:latest
docker push public.ecr.aws/b6l5k5p0/base-image:latest
