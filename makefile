sonar:
	docker run -i -v "${PWD}":/usr/app sonarsource/sonar-scanner-cli sonar-scanner \
	-Dsonar.projectKey=${SERVICE_NAME} \
	-Dsonar.host.url=${SONAR_URL} \
	-Dsonar.login=${SONAR_TOKEN} \
	-Dsonar.sources=/usr/app/app \
	-Dsonar.language=js \
	-Dsonar.prettier.prettierconfigpath=/usr/app/.prettierrc \
	-Dsonar.tests=/usr/app/tests \
	-Dsonar.test.inclusions=**/*.*test.js \
	-Dsonar.javascript.lcov.reportPaths=/usr/app/coverage/lcov.info \
	-Dsonar.qualitygate.wait=true

login:
	eval $(shell aws ecr get-login --no-include-email --region us-east-2)

build: login
	docker build -t ${SERVICE_NAME} .

tag: build
	docker tag ${SERVICE_NAME}:latest 521520363775.dkr.ecr.us-east-2.amazonaws.com/${SERVICE_NAME}:${BITBUCKET_BUILD_NUMBER}

push: tag
	docker push 521520363775.dkr.ecr.us-east-2.amazonaws.com/${SERVICE_NAME}:${BITBUCKET_BUILD_NUMBER}

dev: login
	docker run -i \
	-e K8S_CLUSTER=${PADDY_K8S_CLUSTER} \
	-e AWS_ACCESS_KEY_ID=${PADDY_AWS_ACCESS_KEY_ID} \
	-e AWS_SECRET_ACCESS_KEY=${PADDY_AWS_SECRET_ACCESS_KEY} \
	-e AWS_DEFAULT_REGION=${PADDY_AWS_DEFAULT_REGION} \
	-e VAULT_ADDR=${VAULT_ADDR} \
	-e VAULT_NAMESPACE=${VAULT_NAMESPACE} \
	-e VAULT_APP_ROLE_ID=${VAULT_APP_ROLE_ID} \
	-e VAULT_APP_SECRET_ID=${VAULT_APP_SECRET_ID} \
	521520363775.dkr.ecr.us-east-2.amazonaws.com/eshu:${ESHU_VERSION} helm ${SERVICE_NAME} ${ENV} ${BITBUCKET_BUILD_NUMBER}
staging: login
	docker run -i \
	-e K8S_CLUSTER=${DUDU_K8S_CLUSTER} \
	-e AWS_ACCESS_KEY_ID=${DUDU_AWS_ACCESS_KEY_ID} \
	-e AWS_SECRET_ACCESS_KEY=${DUDU_AWS_SECRET_ACCESS_KEY} \
	-e AWS_DEFAULT_REGION=${DUDU_AWS_DEFAULT_REGION} \
	-e VAULT_ADDR=${VAULT_ADDR} \
	-e VAULT_NAMESPACE=${VAULT_NAMESPACE} \
	-e VAULT_APP_ROLE_ID=${VAULT_APP_ROLE_ID} \
	-e VAULT_APP_SECRET_ID=${VAULT_APP_SECRET_ID} \
	521520363775.dkr.ecr.us-east-2.amazonaws.com/eshu:${ESHU_VERSION} helm ${SERVICE_NAME} ${ENV} ${BITBUCKET_BUILD_NUMBER}
deploy: login
	docker run -i \
	-e VAULT_ADDR=${VAULT_ADDR} \
	-e VAULT_NAMESPACE=${VAULT_NAMESPACE} \
	-e VAULT_APP_ROLE_ID=${VAULT_APP_ROLE_ID} \
	-e VAULT_APP_SECRET_ID=${VAULT_APP_SECRET_ID} \
	-e AWS_ACCESS_KEY_ID=${AWS_ACCESS_KEY_ID} \
	-e AWS_SECRET_ACCESS_KEY=${AWS_SECRET_ACCESS_KEY} \
	-e AWS_DEFAULT_REGION=${AWS_DEFAULT_REGION} \
	521520363775.dkr.ecr.us-east-2.amazonaws.com/eshu:${ESHU_VERSION} deploy ${SERVICE_NAME} ${ENV} ${BITBUCKET_BUILD_NUMBER}
failover: login
	docker run -i \
	-e K8S_CLUSTER=${PROD_K8S_CLUSTER} \
	-e AWS_ACCESS_KEY_ID=${AWS_ACCESS_KEY_ID} \
	-e AWS_SECRET_ACCESS_KEY=${AWS_SECRET_ACCESS_KEY} \
	-e AWS_DEFAULT_REGION=${AWS_PROD_DEFAULT_REGION} \
	-e VAULT_ADDR=${VAULT_ADDR} \
	-e VAULT_NAMESPACE=${VAULT_NAMESPACE} \
	-e VAULT_APP_ROLE_ID=${VAULT_APP_ROLE_ID} \
	-e VAULT_APP_SECRET_ID=${VAULT_APP_SECRET_ID} \
	521520363775.dkr.ecr.us-east-2.amazonaws.com/eshu:${ESHU_VERSION} helm ${SERVICE_NAME} ${ENV} ${BITBUCKET_BUILD_NUMBER}