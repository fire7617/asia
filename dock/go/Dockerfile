#
# NOTE: THIS DOCKERFILE IS GENERATED VIA "apply-templates.sh"
#
# PLEASE DO NOT EDIT IT DIRECTLY.
#
# Specifies a parent image
FROM golang:1.18-alpine
#FROM golang:1.18


 
RUN apk add bash curl git binutils bison gcc make go protoc pkgconf librdkafka-dev wget g++
# Creates an app directory to hold your app’s source code
WORKDIR /app
 
# Copies everything from your root directory into /app
COPY go/go.mod /app
COPY go/go.sum /app
COPY go/main.go /app
 
# Installs Go dependencies
RUN go mod tidy

  # install protoc
RUN wget https://github.com/protocolbuffers/protobuf/releases/download/v3.20.0/protobuf-cpp-3.20.0.tar.gz 
#RUN tar -zxvf protobuf-cpp-3.20.0.tar.gz && cd protobuf-3.20.0  &&  ./configure  && make && make install 
#RUN # install protoc-gen-go
RUN go install github.com/golang/protobuf/protoc-gen-go@latest 
RUN go install github.com/favadi/protoc-go-inject-tag@latest
#RUN # install wire
RUN go install github.com/google/wire/cmd/wire@latest
RUN go install google.golang.org/grpc/cmd/protoc-gen-go-grpc@latest
 
RUN ln -s /usr/bin/protoc /usr/local/bin/protoc 
# Builds your app with optional configuration
RUN cd /app && go build -o main 

# Tells Docker which network port your container listens on
#EXPOSE 6080


#install kafka 
RUN cd /tmp && git clone https://github.com/edenhill/librdkafka.git
RUN cd /tmp/librdkafka/ && git checkout -b v1.9.2 tags/v1.9.2 && ./configure --prefix /usr/local &&  make && make install


# Specifies the executable command that runs when the container starts
ENTRYPOINT [ "/app/main" ]
