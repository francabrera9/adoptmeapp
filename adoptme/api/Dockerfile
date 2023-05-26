# Specify a base image
FROM node:alpine

ENV DOCKERIZE_VERSION v0.2.0
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN npm install -g nodemon

# Install some dependencies 
COPY ./ ./
RUN npm install

# # Default command
# CMD ["node", "app"]

RUN chmod +x docker-entrypoint.sh
ENTRYPOINT ./docker-entrypoint.sh