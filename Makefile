test-build:
	docker compose -f compose-test.yml build --no-cache

unit-test74:
	docker compose -f compose-test74.yml up

unit-test80:
	docker compose -f compose-test80.yml up

unit-test81:
	docker compose -f compose-test81.yml up

unit-test82:
	docker compose -f compose-test82.yml up

unit-test83:
	docker compose -f compose-test83.yml up

development-build:
	docker compose -f compose.yml build --no-cache

development:
	docker compose -f compose.yml up
